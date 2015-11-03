<?php

/*
 * Copyright 2013 DocuSign Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace DocuSign\resource;

use DocuSign\service\DocuSign_Service;
use DocuSign\model\DocuSign_AddUser;


class DocuSign_UserResource extends DocuSign_Resource
{

	public function __construct(DocuSign_Service $service)
	{
		parent::__construct($service);
	}

	public function getPermissionProfileList()
	{
		$url = $this->client->getBaseURL() . '/permission_profiles';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getGroupList()
	{
		$url = $this->client->getBaseURL() . '/groups';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getUserList($additional_info = "false")
	{
		$url = $this->client->getBaseURL() . '/users';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders(), array("additional_info" => $additional_info));
	}

	public function getUserInfo($user_id, $additional_info = "false")
	{
		$url = $this->client->getBaseURL() . '/users/' . $user_id;
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders(), array("additional_info" => $additional_info));
	}

	public function getUserSettingList($user_id, $additional_info = "false")
	{
		$url = $this->client->getBaseURL() . '/users/' . $user_id . '/settings';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders(), array("additional_info" => $additional_info));
	}

	public function addUser(DocuSign_AddUser $add_user)
	{
		$url = $this->client->getBaseURL() . '/users';
		$data["newUsers"] = array($add_user->getData());
		return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
	}

	public function closeUser($user_id)
	{
		$url = $this->client->getBaseURL() . '/users';
		$data["users"] = array(array("userId" => $user_id));
		return $this->curl->makeRequest($url, 'DELETE', $this->client->getHeaders(), array(), json_encode($data));
	}

	public function getUserProfile($user_id)
	{
		// To view a user profile, the SendOnBehalfOf (SOBO) functionality must also be used. To use this
		// functionality, we require the user email address that matches the supplied userid. For this 
		// implementation, we use the getUserInfo method to look up that email address.
		$user_info = $this->getUserInfo($user_id);
		$sobo_user_email = $user_info->email;
		$url = $this->client->getBaseURL() . '/users/' . $user_id . '/profile';
		// As part of the SendOnBehalfOf functionality, we must supply the user email address in the header.
		return $this->curl->makeRequest($url, 'GET', $this->client->getSoboHeaders($sobo_user_email));
	}

	public function modifyUserProfile($user_id, $user_profile)
	{
		// To modify a user profile, the SendOnBehalfOf (SOBO) functionality must also be used. To use this
		// functionality, we require the user email address that matches the supplied userid. For this 
		// implementation, we use the getUserInfo method to look up that email address.
		$user_info = $this->getUserInfo($user_id);
		$sobo_user_email = $user_info->email;
		$url = $this->client->getBaseURL() . '/users/' . $user_id . '/profile';
		// As part of the SendOnBehalfOf functionality, we must supply the user email address in the header.
		return $this->curl->makeRequest($url, 'PUT', $this->client->getSoboHeaders($sobo_user_email), array(), json_encode($user_profile->getData()));
	}

}
