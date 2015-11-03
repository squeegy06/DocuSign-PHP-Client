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

class DocuSign_Recipient extends DocuSign_Model
{

	private $routingOrder;
	private $id;
	private $name;
	private $email;
	private $clientId;
	private $type;
	private $tabs;

	public function __construct($routingOrder, $id, $name, $email, $clientId = NULL, $type = 'signers', $tabs = NULL)
	{
		if (isset($routingOrder))
			$this->routingOrder = $routingOrder;
		if (isset($id))
			$this->id = $id;
		if (isset($name))
			$this->name = $name;
		if (isset($email))
			$this->email = $email;
		if (isset($type))
			$this->type = $type;
		// Ensure that a client id only gets assigned to allowed recipient types.
		if (isset($clientId))
		{
			switch ($type)
			{
				case 'signers':
				case 'agents':
				case 'intermediaries':
				case 'editors':
				case 'certifiedDeliveries':
					$this->clientId = $clientId;
					break;
			}
		}
		if (isset($tabs) && is_array($tabs))
		{
			foreach ($tabs as $tabType => $tab)
			{
				foreach ($tab as $singleTab)
				{
					$this->setTab($tabType, $singleTab);
				}
			}
		}
	}

	public function setRoutingOrder($routingOrder)
	{
		$this->routingOrder = $routingOrder;
	}

	public function getRoutingOrder()
	{
		return $this->routingOrder;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setClientId($clientId)
	{
		$this->clientId = $clientId;
	}

	public function getClientId()
	{
		return $this->clientId;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getTabs()
	{
		return $this->tabs;
	}

	public function getTab($tabType, $tabLabel)
	{
		foreach ($this->tabs[$tabType] as $tab)
		{
			if ($tab['tabLabel'] == $tabLabel)
			{
				return array($tabType => $tab);
			}
		}
	}

	public function setTab($tabType, $tab)
	{
		//.. construct tab array
		switch ($tabType)
		{
			case 'approveTabs':
			case 'checkboxTabs':
			case 'companyTabs':
			case 'dateSignedTabs':
			case 'dateTabs':
			case 'declineTabs':
			case 'emailTabs':
			case 'emailAddressTabs':
			case 'envelopeIdTabs':
			case 'firstNameTabs':
			case 'formulaTabs':
			case 'fullNameTabs':
			case 'initialHereTabs':
			case 'lastNameTabs':
			case 'noteTabs':
			case 'listTabs':
			case 'numberTabs':
			case 'radioGroupTabs':
			case 'signHereTabs':
			case 'signerAttachmentTabs':
			case 'ssnTabs':
			case 'textTabs':
			case 'titleTabs':
			case 'zipTabs':
				$this->tabs[$tabType][] = $tab;
				break;
		};
	}

	public function unsetTab($tabType, $tabLabel)
	{
		foreach ($this->tabs[$tabType] as &$tab)
		{
			if ($tab['tabLabel'] == $tabLabel)
			{
				unset($tab);
			}
		}
	}

}
