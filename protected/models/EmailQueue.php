<?php



/**
 * This is the model class for table "tbl_email_queue".
 *
 * @property integer $id
 * @property string $from_email
 * @property string $to_email
 * @property string $message
 * @property string $subject
 * @property string $date_published
 * @property string $last_attempt
 * @property string $date_sent
 * @property integer $attempts
 * @property integer $state_id
 * @property integer $email_id
 * @property integer $project_id
 *
 */
namespace app\models;


class EmailQueue extends \app\components\TEmailQueue
		{}
