<?php

    namespace Couponcity\Services;

    use Mail;
    use Notification;
    use Queue;
    use User;

    class NotificationService
    {

        const TIME_DELAY_SECONDS = 5;

        public function byEmail($view, $data = [], $email, $subject = "PrintRabiit:: Notification")
        {

            Mail::queue($view, $data,
                function ($message) use ($email, $subject) {
                    $message
                        ->from('gate-keeper@printrabbit.net', 'PrintRabbit')
                        ->to($email)
                        ->subject($subject);
                });
        }

        public function bySms($destination, $message)
        {
            $this->queueMessage($destination, $message);
        }

        public function createMerchantPaymentNotification($user, $printjob)
        {
            $user = is_object($user) ? $user : User::find($user);
            $notification = new Notification();
            $notification->subject = 'PrintRabbit: Job Payment Notification';
            $notification->body = "The payment for printing {$printjob->document_name} has been credited to your wallet,
                                but you can't withdraw till we verify the document was indeed printed.";
            $notification->from = 'Team PrintRabbit';
            $notification->user_id = $user->id;
            $notification->priority = 1;
            $notification->save();

            $this->byEmail('emails.default',
                ['useremail' => $user->email, 'body' => $notification->body],
                $user->email, $notification->subject);

            if (isset($user->phone) && !empty($user->phone)) {
                $this->queueMessage($user->phone, $notification->body);
            }
        }
        public function createWelcomeNotification($user, $user_type = 'member')
        {
            $user = is_object($user) ? $user : User::find($user);
            $notification = new Notification();
            $notification->subject = 'Welcome to PrintRabbit';
            $notification->body = 'We, the printrabbit team are glad you decided to join our platform.We promise you an excellent service' .
                ' delivery. If you need assistance simply email admin@printrabbit.net. cheers.';
            $notification->from = 'Team PrintRabbit';
            $notification->user_id = $user->id;
            $notification->priority = 1;
            $notification->save();

            switch ($user_type) {
                case 'merchant':
                    $user_mail_view = 'emails.merchant_welcome';
                    break;
                case 'shipping_partner':
                    $user_mail_view = 'emails.shipping_welcome';
                    break;
                default:
                    $user_mail_view = 'emails.welcome';
                    break;
            }

            $this->byEmail($user_mail_view,
                array('useremail' => $user->email),
                $user->email, 'Welcome to PrintRabbit');

            if (isset($user->phone) && !empty($user->phone)) {
                $this->queueMessage($user->phone, $notification->body);
            }

        }

        public function createPrintjobSuccessNotification($user, $printjob)
        {
            $user = is_object($user) ? $user : User::find($user);
            $notification = new Notification();
            $notification->subject = $printjob->document_name . ' Printjob Successfully Created';
            $notification->body = 'Your printjob ' . $printjob->document_name . ' has been created successfully created, rest assured we are on it and ' .
                'we will send you an sms once it is ready';
            $notification->from = 'Team PrintRabbit';
            $notification->user_id = $user->id;
            $notification->priority = 1;
            $notification->save();

            $this->byEmail('emails.print_job_success',
                array('doc_name' => $printjob->document_name),
                $user->email, $notification->subject);


            if (isset($user->phone) && !empty($user->phone)) {
                $this->queueMessage($user->phone, $notification->body);
            }
        }

        public function createPrintjobPrintedSuccessNotification($user, $printjob)
        {
            $user = is_object($user) ? $user : User::find($user);
            $notification = new Notification();
            $notification->subject = $printjob->document_name . ' Printjob Printed Successfully';
            $notification->body = 'Your printjob ' . $printjob->document_name . ' has been printed successfully and is enroute to your address now';
            $notification->from = 'Team PrintRabbit';
            $notification->user_id = $user->id;
            $notification->priority = 1;
            $notification->save();

            $this->byEmail('emails.print_job_success',
                array('doc_name' => $printjob->document_name),
                $user->email, $notification->subject);


            if (isset($user->phone) && !empty($user->phone)) {
                $this->queueMessage($user->phone, $notification->body);
            }

        }


        public function createMerchantPrintActionNotification($merchant, $printjob)
        {
            $merchant = is_object($merchant) ? $merchant : User::find($merchant);
            $notification = new Notification();
            $notification->subject = $printjob->document_name . ' Printjob Assigned to You';
            $notification->body = 'PrintRabit: the printjob {' . $printjob->id . "} has been " .
                "assigned to you to print. you are required to accept to print this document by replying 'yes $printjob->id' " .
                "within the next 15 mins or it will be reassigned.cheers";
            $notification->from = 'Team PrintRabbit';
            $notification->user_id = $merchant->id;
            $notification->priority = 1;
            $notification->save();

            $this->byEmail('emails.merchant_print_action',
                array('printjob_id' => $printjob->id, 'printjob_document_name' => $printjob->document_name),
                $merchant->email, $notification->subject);

            if (isset($merchant->phone) && !empty($merchant->phone)) {
                $this->queueMessage($merchant->phone, $notification->body);
            }
        }

        public function createAdminPrintActionNotification($printjob)
        {
            $admin = (new User)->getAdmin()->first();
            $notification = new Notification();
            $notification->subject = $printjob->document_name . ' Printjob Assigned to You Admin';
            $notification->body = 'This is to notify you that the printjob {' . $printjob->id . "} $printjob->document_name has been " .
                "assigned to you to print because we couldn't get a merchant. you are required to accept to print this document by sending 'yes $printjob->id' " .
                "to 000000 or sending it as email to 'gate-keeper@printrabbit.net' within the next 15 mins or it will be reassigned. Thank you for being part of our team. cheers";
            $notification->from = 'Team PrintRabbit';
            $notification->user_id = $admin->id;
            $notification->priority = 1;
            $notification->save();

            $this->byEmail('emails.admin_print_action',
                array('printjob' => $printjob),
                $admin->email, $notification->subject);


            if (isset($admin->phone) && !empty($admin->phone)) {
                $this->queueMessage($admin->phone, $notification->body);
            }

        }

        public function queueMessage($destination, $message)
        {
            Queue::push('PrintRabbit\Services\SmsHandlerService',
                array('destination' => $destination, 'message' => $message));
        }

        public function createShippingActionNotification($user, $printjob)
        {
            $user = is_object($user) ? $user : User::find($user);
            $notification = new Notification();
            $notification->subject = 'PrintRabbit: Shipping required!';
            $notification->body = "The {$printjob->document_name} has been printed,
                                please head over to {$printjob->merchant->address}
                                and pick up the job and deliver it to {$printjob->address}";
            $notification->from = 'Team PrintRabbit';
            $notification->user_id = $user->id;
            $notification->priority = 1;
            $notification->save();

            $this->byEmail('emails.default',
                ['useremail' => $user->email, 'body' => $notification->body],
                $user->email, $notification->subject);

            if (isset($user->phone) && !empty($user->phone)) {
                $this->queueMessage($user->phone, $notification->body);
            }
        }

        public function createAdminShipActionNotification($printjob)
        {
            $admin = (new User)->getAdmin()->first();
            $notification = new Notification();
            $notification->subject = $printjob->document_name . ' Printjob Assigned to You Admin';
            $notification->body = 'This is to notify you that the printjob {' . $printjob->id . "} $printjob->document_name has been " .
                "assigned to you to print because we couldn't get a shipping partner.Please head over to {$printjob->merchant->address}
                                and pick up the job and deliver it to {$printjob->address}";
            $notification->from = 'Team PrintRabbit';
            $notification->user_id = $admin->id;
            $notification->priority = 1;
            $notification->save();

            $this->byEmail('emails.admin_print_action',
                array('printjob' => $printjob),
                $admin->email, $notification->subject);


            if (isset($admin->phone) && !empty($admin->phone)) {
                $this->queueMessage($admin->phone, $notification->body);
            }

        }
    }