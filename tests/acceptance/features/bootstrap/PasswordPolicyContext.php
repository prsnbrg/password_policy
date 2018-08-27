<?php
/**
 * ownCloud
 *
 * @author Phil Davis <info@jankaritech.com>
 * @copyright Copyright (c) 2018 Phil Davis info@jankaritech.com
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use TestHelpers\AppConfigHelper;
use TestHelpers\SetupHelper;

require_once 'bootstrap.php';

/**
 * Context for password policy specific steps
 */
class PasswordPolicyContext implements Context {

	/**
	 * @var FeatureContext
	 */
	private $featureContext;

	/**
	 * @param string $enabledOrDisabled
	 *
	 * @return string "on" or ""
	 */
	private function appSettingIsExpectedToBe($enabledOrDisabled) {
		if (\substr($enabledOrDisabled, 0, 6) === "enable") {
			return 'on';
		} else {
			return '';
		}
	}

	/**
	 * @When /^the administrator (enables|disables) the minimum characters password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the minimum characters password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesMinimumCharactersPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_min_chars_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the lowercase letters password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the lowercase letters password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesLowercaseLettersPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_lowercase_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the uppercase letters password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the uppercase letters password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesUppercaseLettersPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_uppercase_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the numbers password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the numbers password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesNumbersPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_numbers_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the special characters password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the special characters password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesSpecialCharactersPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_special_chars_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the restrict to these special characters password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the restrict to these special characters password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesRestrictSpecialCharactersPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_def_special_chars_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the last passwords user password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the last passwords user password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesLastPasswordsPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_password_history_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the days until user password expires user password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the days until user password expires user password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesDaysUntilUserPasswordExpiresPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_user_password_expiration_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the notification days before password expires user password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the notification days before password expires user password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesNotificationDaysBeforeUserPasswordExpiresPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_user_password_expiration_notification_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the force password change on first login user password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the force password change on first login user password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesForcePasswordChangeOnFirstLoginPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_user_password_force_change_on_first_login_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the days until link expires if password is set public link password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the days until link expires if password is set public link password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesDaysUntilLinkExpiresWithPasswordPublicLinkPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_expiration_password_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @When /^the administrator (enables|disables) the days until link expires if password is not set public link password policy using the occ commmand$/
	 * @Given /^the administrator has (enabled|disabled) the days until link expires if password is not set public link password policy$/
	 *
	 * @param string $action
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theAdminTogglesDaysUntilLinkExpiresWithoutPasswordPublicLinkPasswordPolicyUsingOcc(
		$action
	) {
		$this->setPasswordPolicySetting(
			'spv_expiration_nopassword_checked',
			$this->appSettingIsExpectedToBe($action)
		);
	}

	/**
	 * @Then /^the minimum characters password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theMinimumCharactersPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_min_chars_checked'
			)
		);
	}

	/**
	 * @Then /^the lowercase letters password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theLowercaseLettersPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_lowercase_checked'
			)
		);
	}

	/**
	 * @Then /^the uppercase letters password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theUppercaseLettersPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_uppercase_checked'
			)
		);
	}

	/**
	 * @Then /^the numbers password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theNumbersPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_numbers_checked'
			)
		);
	}

	/**
	 * @Then /^the special characters password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theSpecialCharactersPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_special_chars_checked'
			)
		);
	}

	/**
	 * @Then /^the restrict to these special characters password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theRestrictSpecialCharactersPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_def_special_chars_checked'
			)
		);
	}

	/**
	 * @Then /^the last passwords user password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theLastPasswordsPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_password_history_checked'
			)
		);
	}

	/**
	 * @Then /^the days until user password expires user password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theDaysUntilUserPasswordExpiresPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_user_password_expiration_checked'
			)
		);
	}

	/**
	 * @Then /^the notification days before password expires user password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theNotificationDaysBeforeUserPasswordExpiresPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_user_password_expiration_notification_checked'
			)
		);
	}

	/**
	 * @Then /^the force password change on first login user password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theForcePasswordChangeOnFirstLoginPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_user_password_force_change_on_first_login_checked'
			)
		);
	}

	/**
	 * @Then /^the days until link expires if password is set public link password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theDaysUntilLinkExpiresWithPasswordPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_expiration_password_checked'
			)
		);
	}

	/**
	 * @Then /^the days until link expires if password is not set public link password policy should be (enabled|disabled)$/
	 *
	 * @param string $enabledOrDisabled
	 *
	 * @return void
	 * @throws Exception
	 */
	public function theDaysUntilLinkExpiresWithoutPasswordPasswordPolicyShouldBe(
		$enabledOrDisabled
	) {
		PHPUnit_Framework_Assert::assertEquals(
			$this->appSettingIsExpectedToBe($enabledOrDisabled),
			$this->getPasswordPolicySetting(
				'spv_expiration_nopassword_checked'
			)
		);
	}

	/**
	 *
	 * @param string $setting
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getPasswordPolicySetting($setting) {
		$occResult = SetupHelper::runOcc(
			[
				'config:app:get',
				'password_policy',
				$setting
			]
		);
		if ($occResult['code'] !== "0") {
			// The setting is not set. This is expected if settings have never
			// been saved yet. Treat this as the empty string.
			return '';
		}
		return \trim($occResult['stdOut']);
	}

	/**
	 *
	 * @param string $setting
	 * @param string $value
	 *
	 * @throws \Exception
	 * @return void
	 */
	public function setPasswordPolicySetting($setting, $value) {
		$occResult = SetupHelper::runOcc(
			[
				'config:app:set',
				'password_policy',
				$setting,
				'--value',
				$value
			]
		);
		if ($occResult['code'] !== "0") {
			throw new \Exception(
				__METHOD__ .
				"\ncould not set '$setting' for password_policy app\n" .
				"error message: " . $occResult['code']
			);
		}
	}

	/**
	 *
	 * @param string $setting
	 *
	 * @throws \Exception
	 * @return void
	 */
	public function deletePasswordPolicySetting($setting) {
		$occResult = SetupHelper::runOcc(
			[
				'config:app:delete',
				'password_policy',
				$setting
			]
		);
		if ($occResult['code'] !== "0") {
			throw new \Exception(
				__METHOD__ .
				"\ncould not delete '$setting' for password_policy app\n" .
				"error message: " . $occResult['code']
			);
		}
	}

	/**
	 * @BeforeScenario
	 *
	 * @param BeforeScenarioScope $scope
	 *
	 * @return void
	 * @throws Exception
	 */
	public function setUpScenario(BeforeScenarioScope $scope) {
		// Get the environment
		$environment = $scope->getEnvironment();
		// Get all the contexts you need in this context
		$this->featureContext = $environment->getContext('FeatureContext');
		SetupHelper::init(
			$this->featureContext->getAdminUsername(),
			$this->featureContext->getAdminPassword(),
			$this->featureContext->getBaseUrl(),
			$this->featureContext->getOcPath()
		);

		// TODO: Think about if we care enough to remember the current settings
		//       and put them back at the end of each scenario. That is not
		//       necessary during CI runs. But it is nice to developers who
		//       run test scenarios locally.

		// Delete all app config settings so they are at their defaults
		$configKeys = [
			'spv_def_special_chars_checked',
			'spv_def_special_chars_value',
			'spv_expiration_nopassword_checked',
			'spv_expiration_nopassword_value',
			'spv_expiration_password_checked',
			'spv_expiration_password_value',
			'spv_lowercase_checked',
			'spv_lowercase_value',
			'spv_min_chars_checked',
			'spv_min_chars_value',
			'spv_numbers_checked',
			'spv_numbers_value',
			'spv_password_history_checked',
			'spv_password_history_value',
			'spv_special_chars_checked',
			'spv_special_chars_value',
			'spv_uppercase_checked',
			'spv_uppercase_value',
			'spv_user_password_expiration_checked',
			'spv_user_password_expiration_value',
			'spv_user_password_expiration_notification_checked',
			'spv_user_password_expiration_notification_value',
			'spv_user_password_force_change_on_first_login_checked'
		];

		$appConfigSettingsToDelete = [];
		foreach ($configKeys as $configKey) {
			$appConfigSettingsToDelete[] = [
				'appid' => 'password_policy',
				'configkey' => $configKey
			];
		}

		AppConfigHelper::deleteAppConfigs(
			$this->featureContext->getBaseUrl(),
			$this->featureContext->getAdminUsername(),
			$this->featureContext->getAdminPassword(),
			$appConfigSettingsToDelete
		);
	}
}
