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

namespace DocuSign\model;

class DocuSign_EventNotification extends DocuSign_Model
{

	private $url;
	private $loggingEnabled;
	private $requireAcknowledgment;
	private $useSoapInterface;
	private $soapNameSpace;
	private $includeCertificateWithSoap;
	private $signMessageWithX509Cert;
	private $includeDocuments;
	private $includeTimeZone;
	private $includeSenderAccountAsCustomField;
	private $envelopeEvents;
	private $recipientEvents;

	public function __construct($url
	, $loggingEnabled
	, $requireAcknowledgment
	, $useSoapInterface
	, $soapNameSpace
	, $includeCertificateWithSoap
	, $signMessageWithX509Cert
	, $includeDocuments
	, $includeTimeZone
	, $includeSenderAccountAsCustomField
	, $envelopeEvents
	, $recipientEvents)
	{
		if (isset($url))
			$this->url = $url;
		if (isset($loggingEnabled))
			$this->loggingEnabled = $loggingEnabled;
		if (isset($requireAcknowledgment))
			$this->requireAcknowledgment = $requireAcknowledgment;
		if (isset($useSoapInterface))
			$this->useSoapInterface = $useSoapInterface;
		if (isset($soapNameSpace))
			$this->soapNameSpace = $soapNameSpace;
		if (isset($includeCertificateWithSoap))
			$this->includeCertificateWithSoap = $includeCertificateWithSoap;
		if (isset($signMessageWithX509Cert))
			$this->signMessageWithX509Cert = $signMessageWithX509Cert;
		if (isset($includeDocuments))
			$this->includeDocuments = $includeDocuments;
		if (isset($includeTimeZone))
			$this->includeTimeZone = $includeTimeZone;
		if (isset($includeSenderAccountAsCustomField))
			$this->includeSenderAccountAsCustomField = $includeSenderAccountAsCustomField;
		if (isset($envelopeEvents))
			$this->envelopeEvents = $envelopeEvents;
		if (isset($recipientEvents))
			$this->recipientEvents = $recipientEvents;
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function setLoggingEnabled($loggingEnabled)
	{
		$this->loggingEnabled = $loggingEnabled;
	}

	public function getLoggingEnabled()
	{
		return $this->loggingEnabled;
	}

	public function setRequireAcknowledgment($requireAcknowledgment)
	{
		$this->requireAcknowledgment = $requireAcknowledgment;
	}

	public function getRequireAcknowledgment()
	{
		return $this->requireAcknowledgment;
	}

	public function setUseSoapInterface($useSoapInterface)
	{
		$this->useSoapInterface = $useSoapInterface;
	}

	public function getUseSoapInterface()
	{
		return $this->useSoapInterface;
	}

	public function setSoapNameSpace($soapNameSpace)
	{
		$this->soapNameSpace = $soapNameSpace;
	}

	public function getSoapNameSpace()
	{
		return $this->soapNameSpace;
	}

	public function setIncludeCertificateWithSoap($includeCertificateWithSoap)
	{
		$this->includeCertificateWithSoap = $includeCertificateWithSoap;
	}

	public function getIncludeCertificateWithSoap()
	{
		return $this->includeCertificateWithSoap;
	}

	public function setSignMessageWithX509Cert($signMessageWithX509Cert)
	{
		$this->signMessageWithX509Cert = $signMessageWithX509Cert;
	}

	public function getSignMessageWithX509Cert()
	{
		return $this->signMessageWithX509Cert;
	}

	public function setIncludeDocuments($includeDocuments)
	{
		$this->includeDocuments = $includeDocuments;
	}

	public function getIncludeDocuments()
	{
		return $this->includeDocuments;
	}

	public function setIncludeTimeZone($includeTimeZone)
	{
		$this->includeTimeZone = $includeTimeZone;
	}

	public function getIncludeTimeZone()
	{
		return $this->includeTimeZone;
	}

	public function setIncludeSenderAccountAsCustomField($includeSenderAccountAsCustomField)
	{
		$this->includeSenderAccountAsCustomField = $includeSenderAccountAsCustomField;
	}

	public function getIncludeSenderAccountAsCustomField()
	{
		return $this->includeSenderAccountAsCustomField;
	}

	public function setEnvelopeEvents($envelopeEvents)
	{
		$this->envelopeEvents = $envelopeEvents;
	}

	public function getEnvelopeEvents()
	{
		return $this->envelopeEvents;
	}

	public function setRecipientEvents($recipientEvents)
	{
		$this->recipientEvents = $recipientEvents;
	}

	public function getRecipientEvents()
	{
		return $this->recipientEvents;
	}

	public function toArray()
	{
		$result = array();
		if (isset($this->url))
			$result['url'] = $this->url;
		if (isset($this->loggingEnabled))
			$result['loggingEnabled'] = $this->loggingEnabled;
		if (isset($this->requireAcknowledgment))
			$result['requireAcknowledgment'] = $this->requireAcknowledgment;
		if (isset($this->useSoapInterface))
			$result['useSoapInterface'] = $this->useSoapInterface;
		if (isset($this->soapNameSpace))
			$result['soapNameSpace'] = $this->soapNameSpace;
		if (isset($this->includeCertificateWithSoap))
			$result['includeCertificateWithSoap'] = $this->includeCertificateWithSoap;
		if (isset($this->signMessageWithX509Cert))
			$result['signMessageWithX509Cert'] = $this->signMessageWithX509Cert;
		if (isset($this->includeDocuments))
			$result['includeDocuments'] = $this->includeDocuments;
		if (isset($this->includeTimeZone))
			$result['includeTimeZone'] = $this->includeTimeZone;
		if (isset($this->includeSenderAccountAsCustomField))
			$result['includeSenderAccountAsCustomField'] = $this->includeSenderAccountAsCustomField;
		if (isset($this->envelopeEvents) && sizeof($this->envelopeEvents) > 0)
		{
			$temp = array();
			foreach ($this->envelopeEvents as $envelopeEvent)
			{
				$item = array();
				$item['envelopeEventStatusCode'] = $envelopeEvent;
				array_push($temp, $item);
			}
			if (count($temp) > 0)
				$result['envelopeEvents'] = $temp;
		}
		if (isset($this->recipientEvents) && sizeof($this->recipientEvents) > 0)
		{
			$temp = array();
			foreach ($this->recipientEvents as $recipientEvent)
			{
				$item = array();
				$item['envelopeEventStatusCode'] = $recipientEvents;
				array_push($temp, $item);
			}
			if (count($temp) > 0)
				$result['envelopeEvents'] = $temp;
		}
		return $result;
	}

}
