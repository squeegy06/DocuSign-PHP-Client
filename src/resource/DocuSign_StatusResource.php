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

class DocuSign_StatusResource extends DocuSign_Resource {

	public function __construct(DocuSign_Service $service) {
		parent::__construct($service);
	}


	public function getStatus($fromDate, $status) {
		$date = date("m", $fromDate) . "/" . date("d", $fromDate) . "/". date("Y", $fromDate) . " " . date("H", $fromDate) . ":" . date("i", $fromDate);
		$url = $this->client->getBaseURL() . '/envelopes';
		$params = array (
			"from_date" => $date,
			"from_to_status" => $status
		);

		return $this->curl->makeRequest($url, 'GET', $this->client->getHeaders(), $params);
	}

}