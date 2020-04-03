<?php

namespace Jacksonit\CNSMS;

use Validator;


class CNSMSCharge
{
    public $APIKEY = '';
    public $SECRETKEY = '';
    public $BRANDNAME = '';
    public $URL_API = '';

    /**
     * Create new
     *
     * @return void
     */
    public function __construct()
    {
        $this->APIKEY       = config('sms.APIKEY');
        $this->SECRETKEY    = config('sms.SECRETKEY');
        $this->BRANDNAME    = config('sms.BRANDNAME');
        $this->URL_API      = config('sms.URL_API');
    }

    /**
     *
     * @param array $input
     * @return Response
     */
    public function send($phone, $content)
    {
        try {
            $validator = $this->validator(['phone' => $phone, 'content' => $content]);
            if ($validator->fails()){
                throw new \Exception($validator->errors()->first());
            }

            $client = new \GuzzleHttp\Client();
            $data_send = [
                'api_key'       => $this->APIKEY,
                'secret_key'    => $this->SECRETKEY,
                'brand_name'    => $this->BRANDNAME
                'phone'         => $phone,
                'content'       => $content
            ];

            $response = $client->request('POST', $record_server->ip,  [
                'form_params' => $data_send
            ]);

            if(strpos($response->getBody(), 'OK') === false) {
                throw new \Exception('Error send');
            }
            return ['result'=> 'OK'];
        } catch (\Exception $e) {
            return ['result'=> 'NG', 'message' => $e->getMessage()];
        }
    }

    /**
     * Validator input.
     *
     * @param array $input
     * @return JsonResponse
     */
    protected function validator($data)
    {
        return Validator::make($data, [
            'phone' => 'required',
            'content' => 'required'
        ]);
    }
}