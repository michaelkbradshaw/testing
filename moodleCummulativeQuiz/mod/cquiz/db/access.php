<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Capability definitions for the cquiz module
 *
 * The capabilities are loaded into the database table when the module is
 * installed or updated. Whenever the capability definitions are updated,
 * the module version number should be bumped up.
 *
 * The system has four possible values for a capability:
 * CAP_ALLOW, CAP_PREVENT, CAP_PROHIBIT, and inherit (not set).
 *
 * It is important that capability names are unique. The naming convention
 * for capabilities that are specific to modules and blocks is as follows:
 *   [mod/block]/<plugin_name>:<capabilityname>
 *
 * component_name should be the same as the directory name of the mod or block.
 *
 * Core moodle capabilities are defined thus:
 *    moodle/<capabilityclass>:<capabilityname>
 *
 * Examples: mod/forum:viewpost
 *           block/recent_activity:view
 *           moodle/site:deleteuser
 *
 * The variable name for the capability definitions array is $capabilities
 *
 * @package    mod
 * @subpackage cquiz
 * @copyright  2011 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

		// Ability to see that the quiz exists, and the basic information
		// about it, for example the start date and time limit.
		'mod/cquiz:view' => array(
				'captype' => 'read',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
						'guest' => CAP_ALLOW,
						'student' => CAP_ALLOW,
						'teacher' => CAP_ALLOW,
						'editingteacher' => CAP_ALLOW,
						'manager' => CAP_ALLOW
				)
		),
		
		// Ability to add a new quiz to the course.
				'mod/cquiz:addinstance' => array(
						'riskbitmask' => RISK_XSS,
		
						'captype' => 'write',
						'contextlevel' => CONTEXT_COURSE,
						'archetypes' => array(
								'editingteacher' => CAP_ALLOW,
								'manager' => CAP_ALLOW
						),
						'clonepermissionsfrom' => 'moodle/course:manageactivities'
				),
		
				// Ability to do the quiz as a 'student'.
		'mod/cquiz:attempt' => array(
				'riskbitmask' => RISK_SPAM,
				'captype' => 'write',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
						'student' => CAP_ALLOW
				)
		),
		
		// Ability for a 'Student' to review their previous attempts. Review by
				// 'Teachers' is controlled by mod/quiz:viewreports.
				'mod/cquiz:reviewmyattempts' => array(
				'captype' => 'read',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
					'student' => CAP_ALLOW
					),
				'clonepermissionsfrom' => 'moodle/quiz:attempt'
				),
	
				// Edit the quiz settings, add and remove questions.
				'mod/cquiz:manage' => array(
				'riskbitmask' => RISK_SPAM,
				'captype' => 'write',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
				'editingteacher' => CAP_ALLOW,
				'manager' => CAP_ALLOW
				)
				),

				// Edit the quiz overrides.
				'mod/cquiz:manageoverrides' => array(
				'captype' => 'write',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
				'editingteacher' => CAP_ALLOW,
				'manager' => CAP_ALLOW
				)
				),

				// Preview the quiz.
				'mod/cquiz:preview' => array(
				'captype' => 'write', // Only just a write.
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
				'teacher' => CAP_ALLOW,
				'editingteacher' => CAP_ALLOW,
				'manager' => CAP_ALLOW
				)
				),

				// Manually grade and comment on student attempts at a question.
				'mod/cquiz:grade' => array(
				'riskbitmask' => RISK_SPAM,
				'captype' => 'write',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
					'teacher' => CAP_ALLOW,
					'editingteacher' => CAP_ALLOW,
					'manager' => CAP_ALLOW
					)
				),
		
				// Regrade quizzes.
				'mod/cquiz:regrade' => array(
				'riskbitmask' => RISK_SPAM,
				'captype' => 'write',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
					'teacher' => CAP_ALLOW,
					'editingteacher' => CAP_ALLOW,
					'manager' => CAP_ALLOW
					),
				'clonepermissionsfrom' =>  'mod/cquiz:grade'
				),
		
				// View the quiz reports.
				'mod/cquiz:viewreports' => array(
				'riskbitmask' => RISK_PERSONAL,
				'captype' => 'read',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
				'teacher' => CAP_ALLOW,
				'editingteacher' => CAP_ALLOW,
				'manager' => CAP_ALLOW
				)
				),

				// Delete attempts using the overview report.
				'mod/cquiz:deleteattempts' => array(
				'riskbitmask' => RISK_DATALOSS,
				'captype' => 'write',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array(
				'editingteacher' => CAP_ALLOW,
				'manager' => CAP_ALLOW
				)
				),

				// Do not have the time limit imposed. Used for accessibility legislation compliance.
				'mod/cquiz:ignoretimelimits' => array(
				'captype' => 'read',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array()
				),

				// Receive a confirmation message of own quiz submission.
				'mod/cquiz:emailconfirmsubmission' => array(
				'captype' => 'read',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array()
				),

				// Receive a notification message of other peoples' quiz submissions.
				'mod/cquiz:emailnotifysubmission' => array(
				'captype' => 'read',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array()
				),

				// Receive a notification message when a quiz attempt becomes overdue.
				'mod/cquiz:emailwarnoverdue' => array(
				'captype' => 'read',
				'contextlevel' => CONTEXT_MODULE,
				'archetypes' => array()
				),
		
		
/***************************** remove these comment marks and modify the code as needed
    'mod/cquiz:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'legacy' => array(
            'guest' => CAP_ALLOW,
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'admin' => CAP_ALLOW
        )
    ),

    'mod/cquiz:submit' => array(
        'riskbitmask' => RISK_SPAM,
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'legacy' => array(
            'student' => CAP_ALLOW
        )
    ),
******************************/
);

