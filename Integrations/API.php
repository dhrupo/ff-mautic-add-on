<?php

namespace  FluentFormMautic\Integrations;

class API
{
    protected $apiUrl = '';

    protected $username = null;

    protected $password = null;

    public function __construct($apiUrl, $username, $password)
    {
        $this->apiUrl = $apiUrl;
        $this->username = $username;
        $this->password = $password;
    }

    public function makeAuthString()
    {       
        $userCredentials =  $this->username . ':' . $this->password;
        return $authstring = 'Basic ' . base64_encode($userCredentials);    
    }

    public function make_request($action, $options = array(), $method = 'GET')
    {
        $apiPath = $this->apiUrl . '/api/'. $action;
 
        if($method == 'POST') {
          $response = wp_remote_post(
                $apiPath,
                [
                    'headers' => [
                        'Authorization' => $this->makeAuthString(),
                        'content-type'=> 'application/json'
                    ],
                    'body' => json_encode($options)
                ]     
                
            );
        } else if($method == 'GET') {
                $response = wp_remote_get(
                    $apiPath,
                    [
                        'headers' => [
                            'Authorization' => $this->makeAuthString()
                        ]
                    ]
                );
        }  else {
            return (new \WP_Error(423, 'Request method could not be found'));
        }

        /* If WP_Error, die. Otherwise, return decoded JSON. */
        if (is_wp_error($response)) {
            return [
                'error'   => 'API_Error',
                'message' => $response->get_error_message()
            ];
        } else if ($response && $response['response']['code'] >= 300) {
            return [
                'error'   => 'API_Error',
                'message' => $response['response']['message']
            ];
        }
        return json_decode($response['body'], true);
    }

    /**
     * Test the provided API credentials.
     *
     * @access public
     * @return bool
     */
    public function auth_test()
    {
        return $this->make_request('users', [], 'GET');
    }


    public function subscribe($data)
    {
        $response = $this->make_request('contacts/new', $data, 'POST');
       
        if (!empty($response['error'])) {
            return new \WP_Error('api_error', $response['message']);
        }
        return $response;
    }

    /**
     * Get all Forms in the system.
     *
     * @access public
     * @return array
     */
    public function getGroups()
    {
        $response = $this->make_request('groups', array(), 'GET');
        if (empty($response['error'])) {
            return $response;
        }
        return [];
    }

    public function getContactFields()
    {
        $response = $this->make_request('fields/contact', array(), 'GET');
  
        if (empty($response['error'])) {
            return $response;
        }
        return false;
    }

}
