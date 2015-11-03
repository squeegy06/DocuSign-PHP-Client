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
use DocuSign\model\DocuSign_TemplateRole;
use DocuSign\model\DocuSign_Document;

class DocuSign_RequestSignatureResource extends DocuSign_Resource
{

	public function __construct(DocuSign_Service $service)
	{
		parent::__construct($service);
	}

	public function createEnvelopeFromTemplate($emailSubject
	, $emailBlurb
	, $templateId
	, $status = "created"
	, $templateRoles = array()
	, $eventNotifications = array())
	{
		$url = $this->client->getBaseURL() . '/envelopes';
		$data = array(
			"emailSubject" => $emailSubject,
			"emailBlurb" => $emailBlurb,
			"templateId" => $templateId,
			"status" => $status
		);
		if (isset($templateRoles) && sizeof($templateRoles) > 0)
		{
			$templateRolesList = array();
			$templateRole = new DocuSign_TemplateRole($templateRole['roleName'], $templateRole['name'], $templateRole['email'], $templateRole['tabs']);
			foreach ($templateRoles as $templateRole)
			{
				$templateRole = new DocuSign_TemplateRole($templateRole['roleName'], $templateRole['name'], $templateRole['email']);
				array_push($templateRolesList, array(
					"roleName" => $templateRole->getRolename(),
					"name" => $templateRole->getName(),
					"email" => $templateRole->getEmail()
				));
			}
			$data['templateRoles'] = $templateRolesList;
		}
		if (isset($eventNotifications) && sizeof($eventNotifications) > 0)
		{
			$data['eventNotification'] = $eventNotifications->toArray();
		}
		return $this->curl->makeRequest($url, 'POST', $this->client->getHeaders(), array(), json_encode($data));
	}

	public function createEnvelopeFromDocument($emailSubject
	, $emailBlurb
	, $status = "created"
	, $documents = array()
	, $recipients = array()
	, $eventNotifications = array()
	, $options = array())
	{
		$url = $this->client->getBaseURL() . '/envelopes';
		$headers = $this->client->getHeaders('Accept: application/json', 'Content-Type: multipart/form-data;boundary=myboundary');
		$doc = array();
		$contentDisposition = '';
		foreach ($documents as $document)
		{
			array_push($doc, array(
				"name" => $document->getName(),
				"documentId" => $document->getId()
			));

			$contentDisposition .= "--myboundary\r\n"
				. "Content-Type:application/pdf\r\n"
				. "Content-Disposition: file; filename=\""
				. $document->getName()
				. "\"; documentid="
				. $document->getId()
				. "\r\n"
				. "\r\n"
				. $document->getContent()
				. "\r\n";
		}
		$data = array(
			"emailSubject" => $emailSubject,
			"emailBlurb" => $emailBlurb,
			"documents" => $doc,
			"status" => $status
		);
		if (!empty($options))
		{
			$data = array_merge($data, $options);
		}
		if (isset($recipients) && sizeof($recipients) > 0)
		{
			$recipientsList = array();
			foreach ($recipients as $recipient)
			{
				$recipientsList[$recipient->getType()][] = array(
					"routingOrder" => $recipient->getRoutingOrder(),
					"recipientId" => $recipient->getId(),
					"name" => $recipient->getName(),
					"email" => $recipient->getEmail(),
					"clientUserId" => $recipient->getClientId(),
					"tabs" => $recipient->getTabs(),
				);
			}
			$data['recipients'] = $recipientsList;
		}
		if (isset($eventNotifications) && sizeof($eventNotifications) > 0)
		{
			$data['eventNotification'] = $eventNotifications->toArray();
		}
		$data_string = json_encode($data);
		$data = "\r\n"
			. "\r\n"
			. "--myboundary\r\n"
			. "Content-Type: application/json\r\n"
			. "Content-Disposition: form-data\r\n"
			. "\r\n"
			. $data_string
			. "\r\n"
			. $contentDisposition
			. "--myboundary--";
		return $this->curl->makeRequest($url, 'POST', $headers, array(), $data);
	}
}
