  @phasing @regression
  Feature: Create New Phasing Event
  In order to cover every possible route throughout the site
  As an automation tester
  I want to build a template with supporting code for each web page

  Scenario: Route 1: Login and create a Phasing Event

    Given I am on the OpenEyes "master" homepage
    And I enter login credentials "admin" and "admin"
    And I select Site "1"
    Then I select a firm of "3"

    Then I search for hospital number "1009465 "

    Then I select the Latest Event

    Then I expand the Glaucoma sidebar
    And I add a New Event "Phasing"

    Then I choose a right eye Intraocular Pressure Instrument  of "1"

    And I choose right eye Dilation of Yes

    Then I choose a right eye Intraocular Pressure Reading Time of "14:00"
    Then I choose a right eye Intraocular Pressure Reading of "5"
    And I add right eye comments of "Right eye comments here"

    Then I choose a left eye Intraocular Pressure Instrument  of "5"

    And I choose left eye Dilation of Yes

    Then I choose a left eye Intraocular Pressure Reading Time of "14:42"
    Then I choose a left eye Intraocular Pressure Reading of "7"
    And I add left eye comments of "Left eye comments here"

    Then I Save the Phasing Event

    Scenario: Route 2: Login and create a Phasing Event

      Given I am on the OpenEyes "master" homepage
      And I enter login credentials "admin" and "admin"
      And I select Site "1"
      Then I select a firm of "1"

      Then I search for hospital number "1009465 "

      Then I select the Latest Event

      Then I expand the Cataract sidebar
      And I add a New Event "Phasing"

      Then I choose a right eye Intraocular Pressure Instrument  of "3"

      And I choose right eye Dilation of No

      Then I choose a right eye Intraocular Pressure Reading Time of "21:00"
      Then I choose a right eye Intraocular Pressure Reading of "14"
      And I add right eye comments of "Right eye comments here"

      Then I choose a left eye Intraocular Pressure Instrument  of "4"

      And I choose left eye Dilation of Yes

      Then I choose a left eye Intraocular Pressure Reading Time of "04:42"
      Then I choose a left eye Intraocular Pressure Reading of "12"
      And I add left eye comments of "Left eye comments here"

      Then I Save the Phasing Event

    Scenario: Route 3: Login and create a Phasing Event

      Given I am on the OpenEyes "master" homepage
      And I enter login credentials "admin" and "admin"
      And I select Site "2"
      Then I select a firm of "3"

      Then I search for hospital number "1009465 "

      Then I select the Latest Event

      Then I expand the Glaucoma sidebar
      And I add a New Event "Phasing"

      Then I choose a right eye Intraocular Pressure Instrument  of "3"

      And I choose right eye Dilation of No

      Then I choose a right eye Intraocular Pressure Reading Time of "08:00"
      Then I choose a right eye Intraocular Pressure Reading of "5"
      And I add right eye comments of "Right eye comments here"

      Then I choose a left eye Intraocular Pressure Instrument  of "3"

      And I choose left eye Dilation of Yes

      Then I choose a left eye Intraocular Pressure Reading Time of "14:42"
      Then I choose a left eye Intraocular Pressure Reading of "9"
      And I add left eye comments of "Left eye comments here"

      Then I Save the Phasing Event

    Scenario: Route 4: Login and create a Phasing Event

      Given I am on the OpenEyes "master" homepage
      And I enter login credentials "admin" and "admin"
      And I select Site "1"
      Then I select a firm of "4"

      Then I search for hospital number "1009465 "

      Then I select the Latest Event

      Then I expand the Medical Retinal sidebar
      And I add a New Event "Phasing"

      Then I choose a right eye Intraocular Pressure Instrument  of "4"

      And I choose right eye Dilation of No

      Then I choose a right eye Intraocular Pressure Reading Time of "08:00"
      Then I choose a right eye Intraocular Pressure Reading of "5"
      And I add right eye comments of "Right eye comments here"

      Then I choose a left eye Intraocular Pressure Instrument  of "1"

      And I choose left eye Dilation of Yes

      Then I choose a left eye Intraocular Pressure Reading Time of "14:42"
      Then I choose a left eye Intraocular Pressure Reading of "9"
      And I add left eye comments of "Left eye comments here"

      Then I Save the Phasing Event