<?php
/*
 * Copyright 2015 DocuSign Inc.
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
namespace DocuSign\service;

use DocuSign\DocuSign_Client;
use DocuSign\resource\DocuSign_UserResource;

class DocuSign_UserService extends DocuSign_Service {

  public $user;

  /**
  * Constructs the internal representation of the DocuSign User service.
  *
  * @param DocuSign_Client $client
  */
  public function __construct(DocuSign_Client $client) {
    parent::__construct($client);
    $this->user = new DocuSign_UserResource($this);
  }
}