<?php

    namespace Couponcity\Services;

    use Mail;
    use Queue;

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

        public function queueMessage($destination, $message)
        {
            Queue::push('PrintRabbit\Services\SmsHandlerService',
                array('destination' => $destination, 'message' => $message));
        }
    }