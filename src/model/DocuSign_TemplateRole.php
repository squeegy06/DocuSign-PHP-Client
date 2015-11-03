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

class DocuSign_TemplateRole extends DocuSign_Model
{

	private $roleName;
	private $name;
	private $email;
	private $tabs;

	public function __construct($roleName, $name, $email, $tabs = NULL)
	{
		if (isset($roleName))
			$this->roleName = $roleName;
		if (isset($name))
			$this->name = $name;
		if (isset($email))
			$this->email = $email;
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

	public function setRoleName($roleName)
	{
		$this->roleName = $roleName;
	}

	public function getRolename()
	{
		return $this->roleName;
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
			case 'signHereTabs':
			case 'initialHereTabs':
			case 'fullNameTabs':
			case 'emailTabs':
			case 'textTabs':
			case 'titleTabs':
			case 'companyTabs':
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
