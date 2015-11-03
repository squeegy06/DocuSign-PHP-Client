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
use DocuSign\model\DocuSign_InitialUser;
use DocuSign\model\DocuSign_ReferralInformation;

class DocuSign_AccountResource extends DocuSign_Resource
{

	public function __construct(DocuSign_Service $service)
	{
		parent::__construct($service);
	}

	public function getAccountProvisioning($appToken)
	{
		$url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/v2/accounts/provisioning';
		$headers = $this->client->getHeaders();
		array_push($headers, 'X-DocuSign-AppToken:' . $appToken);
		return $this->curl->makeRequest($url, 'GET', $headers);
	}

	public function getInfo()
	{
		$url = $this->client->getBaseURL();
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getBillingPlan()
	{
		$url = $this->client->getBaseURL() . '/billing_plan';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getBillingChargeList()
	{
		$url = $this->client->getBaseURL() . '/billing_charges';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getBillingInvoiceList()
	{
		$url = $this->client->getBaseURL() . '/billing_invoices';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getSettingList()
	{
		$url = $this->client->getBaseURL() . '/settings';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getBrandList()
	{
		$url = $this->client->getBaseURL() . '/brands';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function getCustomFieldList()
	{
		$url = $this->client->getBaseURL() . '/custom_fields';
		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders());
	}

	public function createAccount($accountName, $distributorCode, $distributorPassword, $planId, DocuSign_InitialUser $initialUser, DocuSign_ReferralInformation $referralInformation)
	{
		$url = 'https://' . $this->client->getEnvironment() . '.docusign.net/restapi/v2/accounts';
		$data = array(
			"accountName" => $accountName,
			"distributorCode" => $distributorCode,
			"distributorPassword" => $distributorPassword,
			"planInformation" => array("planId" => $planId),
			"initialUser" => array(
				"email" => $initialUser->getEmail(),
				"firstName" => $initialUser->getFirstName(),
				"lastName" => $initialUser->getLastName(),
				"userName" => $initialUser->getUserName(),
				"password" => $initialUser->getPassword(),
			),
			"referralInformation" => array(
				"referralCode" => $referralInformation->getReferralCode(),
				"referrerName" => $referralInformation->getReferrerName(),
			),
		);
		return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
	}

}
