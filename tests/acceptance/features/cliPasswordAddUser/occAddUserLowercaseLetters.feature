@cli
Feature: enforce the required number of lowercase letters in a password when creating a user

  As an administrator
  I want user passwords to always contain a required number of lowercase letters
  So that users cannot set passwords that are too easy to guess

  Background:
    Given the administrator has enabled the lowercase letters password policy
    And the administrator has set the lowercase letters required to "3"

  Scenario Outline: admin creates a user with a password that has enough lowercase letters
    When the administrator creates this user using the occ command:
      | username | password   |
      | Alice    | <password> |
    Then the command should have been successful
    And the command output should contain the text 'The user "Alice" was created successfully'
    And user "Alice" should exist
    And user "Alice" should be able to upload file "filesForUpload/textfile.txt" to "/textfile.txt"
    Examples:
      | password                  |
      | 3LCase                    |
      | moreThan3LowercaseLetters |


  Scenario Outline: admin creates a user with a password that does not have enough lowercase letters
    When the administrator creates this user using the occ command:
      | username | password   |
      | Alice    | <password> |
    Then the command should have failed with exit code 1
    # Long text output comes on multiple lines. Here we just check for enough that will fit on one of the lines.
    And the command error output should contain the text 'The password contains too few lowercase letters. At least 3 lowercase'
    And user "Alice" should not exist
    Examples:
      | password   |
      | 0LOWERCASE |
      | 2lOWERcASE |
