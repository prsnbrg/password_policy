<?php
/**
 *
 * @copyright Copyright (c) 2018, ownCloud GmbH
 * @license GPL-2.0
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

use OCA\PasswordPolicy\Rules\Length;
use OCP\IL10N;

class LengthTest extends \PHPUnit_Framework_TestCase {

	/** @var Length */
	private $r;

	public function setUp() {
		parent::setUp();

		/** @var IL10N | \PHPUnit_Framework_MockObject_MockObject $l10n */
		$l10n = $this->getMockBuilder('\OCP\IL10N')
			->disableOriginalConstructor()->getMock();
		$l10n
			->expects($this->any())
			->method('t')
			->will($this->returnCallback(function($text, $parameters = array()) {
				return vsprintf($text, $parameters);
			}));

		$this->r = new Length($l10n);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Password is too short. Minimum 25 characters are required.
	 */
	public function testTooShort() {
		$this->r->verify('1234567890', 25);
	}

	public function testOkay() {
		$this->r->verify('1234567890', 6);
	}

	/**
	 * @expectedException Exception
	 * @expectedExceptionMessage Password is too short. Minimum 5 characters are required.
	 */
	public function testSpecialCharsTooShort() {
		$this->r->verify('ççç', 5);
	}

	public function testSpecialCharsOkay() {
		$this->r->verify('çççççç', 5);
	}

}
