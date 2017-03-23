<?php

    namespace Froiden\LaravelInstaller\Helpers;

use Illuminate\Contracts\Validation\Validator;

class Reply
{

    /** Return success response
     * @param $messageOrData
     * @return array
     */
    
    public static function success($messageOrData, $data = null)
    {
        $response = [
            'status' => 'success'
        ];

        if (!empty($messageOrData) && !is_array($messageOrData)) {
            $response['message'] = Reply::getTranslated($messageOrData);
        }

        if (is_array($data)){
            $response = array_merge($data, $response);
        }

        if (is_array($messageOrData)) {
            $response = array_merge($messageOrData, $response);
        }

        return $response;
    }

    /** Return error response
     * @param $message
     * @return array
     */
    
    public static function error($message, $errorName = null, $errorData = [])
    {
        return [
            'status' => 'fail',
            'error_name' => $errorName,
            'data' => $errorData,
            'message' => Reply::getTranslated($message)
        ];
    }

    /** Return validation errors
     * @param \Illuminate\Validation\Validator|Validator $validator
     * @return array
     */

    public static function formErrors($validator)
    {
        return [
            'status' => 'fail',
            'errors' => $validator->getMessageBag()->toArray()
        ];
    }

    /** Response with redirect action. This is meant for ajax responses and is not meant for direct redirecting
     * to the page
     * @param $url string to redirect to
     * @param null $message Optional message
     * @return array
     */

    public static function redirect($url, $message = null)
    {
        if ($message) {
            return [
                'status' => 'success',
                'message' => Reply::getTranslated($message),
                'action' => 'redirect',
                'url' => $url
            ];
        }
        else {
            return [
                'status' => 'success',
                'action' => 'redirect',
                'url' => $url
            ];
        }
    }

    private static function getTranslated($message)
    {
        $trans = trans($message);

        if ($trans == $message) {
            return $message;
        }
        else {
            return $trans;
        }
    }

}