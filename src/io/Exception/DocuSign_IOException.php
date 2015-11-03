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
namespace DocuSign\io\Exception;

use DocuSign\io\Exception\DocuSign_Exception;

class DocuSign_IOException extends DocuSign_Exception {
	public function __construct($message = 'Internal Server Error', $code = 500, $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}
