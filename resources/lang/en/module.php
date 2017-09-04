<?php
/**
 * Created by PhpStorm.
 * User: andrewnagyeb
 * Date: 8/8/17
 * Time: 7:15 PM
 */
return [
    'create' => 'Create',
    'created_at' => 'Created At',
    'operations' => 'Operations',
    'save' => 'Save',
    'edit' => 'Edit',
    'view' => 'View',
    'stat' => 'Statistics',
    'update' => 'Update',
    'addnew' => 'Add New',
    'delete' => 'Delete',
    'change' => 'Update',
    'reset' => 'Reset',
    'list' => 'List',
    'back_to_list' => 'Back to list',
    'are_you_sure' => 'Are you sure?',
    'description' => 'Description',
    'submit_quiz' => 'Submit answers',
    'no_entries_in_table' => 'No entries in table',
    'questions' => [
        'name' => 'Question',
        'title' => 'Assign Questions',
        'question-list' => 'Questions List',
        'fields' => [
            'quiz' => 'Quiz',
            'question-text' => 'Question text',
            'code-snippet' => 'Code snippet',
            'answer-explanation' => 'Answer explanation',
            'more-info-link' => 'More info link',
            'input-format' => 'Input Format',
            'output-format' => 'Output Format',
            'grade' => 'Grade',
        ],
    ],
    'questions-options' => [
        'title' => 'Questions',
        'fields' => [
            'quiz' => 'Quiz',
            'question-text' => 'Question text',
            'code-snippet' => 'Code snippet',
            'answer-explanation' => 'Answer explanation',
            'more-info-link' => 'More info link',
            'input-format' => 'Input Format',
            'output-format' => 'Output Format',
            'grade' => 'Mark(s)'
        ],
    ],
    'quizzes' => [
        'create-questions-title' => 'Quiz',
        'course-title' => 'Select Course',
        'title' => 'New Quiz',
        'quizzes-list' => 'Quizzes List',
        'solve' => 'Solve',
        'fields' => [
            'done' => 'DONE',
            'full-mark' => "Full Mark",
            'quiz' => 'Quiz Title',
            'question-text' => 'Question text',
            'code-snippet' => 'Code snippet',
            'answer-explanation' => 'Answer explanation',
            'more-info-link' => 'More info link',
            'input-format' => 'Input Format',
            'output-format' => 'Output Format',
            'duration' => 'Duration [Optional]',
            'start-date' => 'Start Date',
            'end-date' => 'End Date',
        ],
    ],
    'courses' => [
        'relation-title' => 'Course',
        'no-quizzes' => 'No Quizzes Created',
        'title' => 'New Course',
        'view-course' => 'View Course',
        'enroll-course' => 'Enroll',
        'fields' => [
            'created_at' => 'Created at',
            'course' => 'Course Title',
            'access_code' => 'Access Code',
            'desc' => 'Description',
            'excel' => 'Excel Sheet :',
            'assistant_professor' => 'Assistant Professor(s)-Email ( Please separate by coma if they are many ) [Optional]',
            'assistant_professor_title' => 'Assistant Professor(s) [Including You]',
            'no_courses' => 'Sorry you don\'t have courses yet, please create your courses firstly!'
        ],
    ],
    'results' => [
        'title' => 'My Submissions',
        'table-result' => 'Result',
        'fields' => [
            'user' => 'User',
            'question' => 'Question',
            'correct' => 'Correct',
            'date' => 'Date',
            'result' => 'Score',
            'view-result' => 'View result',
        ],
    ],
    'bars' => [
        'top-bar-no-news' => 'No News added yet.',
        'sidebar_quizzes' => 'Quizzes',
        'sidebar_dashboard' => 'Dashboard',
        'sidebar_courses' => 'Courses',
        'sidebar_problems' => 'Problems',
        'sidebar_questions' => 'MCQ Questions',
        'sidebar_results' => 'Results',
        'sidebar_new_users' => 'Request New Users',
        'sidebar_submissions' => 'Submissions',
        'sidebar_announcements' => 'Announcements'
    ],
    'problems' => [
        'problems-list' => 'Problems List',
        'new_problem' => 'New Problem',
        'example-input' => 'Example Input',
        'example-output' => 'Example Output',
        'lang' => 'Language',
        'code' => 'Code',
        'fields' => [
            'problem_desc' => 'Problem Description',
            'problem_grade' => 'Problem Grade',
            'input_format' => 'Input Format',
            'output_format' => 'Output Format',
            'test_cases' => 'Test Cases  ( Please separate inputs by hitting enter, and same for output ):',
            'code_snippet' => 'Code Snippet',
            'more_info_link' => 'More Info Link',
            'selected_quiz' => 'Select Quiz',
            'time_limit' => 'Time Limit (in seconds)',
            'mem_limit' => 'Memory Limit (in kiloBytes)',
            'time_limit_note' => 'Note that maximum time limit is 60 seconds',
            'mem_limit_note' => 'Note that maximum memory limit is 30 MB',
            'testCases' => [
                'input_testcase' => 'Input',
                'output_testcase' => 'Output',
                'title' => 'Test Case'
            ]
        ]

    ],
    'users' => [
        'new-users' => 'Single User Registration',
        'new-users-excel' => 'Excel Sheet Registration',
        'registered-users' => 'Registered Users',
    ],
    'placeholders' => [
        'name' => 'Name',
        'email' => 'E-mail',
        'college-id' => 'College-id',

    ],
    'errors' => [
        'error-saving' => 'There was an error saving your file, please try again.',
        'error-create-user' => 'There was a trouble saving this\these user(s), please make sure of already existing account(s)',
        'error-access-code' => 'Invalid Access Code',
        'error-quiz-made-before' => 'Solve many option is turned off for this quiz.',
        'error-quiz-not-available' => 'Quiz is not available at the moment',
        'error-none-solved' => 'No one has solved this quiz yet.',
        'error-0-courses' => 'You have to create a course first.',
        'error-0-questions' => 'You have assign questions to this quiz first.',
        'error-quiz-pending' => 'Quiz is still being remarked.',
        'error-name-field' => 'please change students names column name in excel file to "name"',
        'error-email-field' => 'please change emails column name in excel file to "email"',
        'error-id-field' => 'please change IDs column name in excel file to "id"',
        'error-access-code' => 'sorry this access code is reserved, please choose another one',
        'error-course-title' => 'sorry this title is reserved, please choose another one',
        'error-grade-problem' => 'please enter grade greater than zero',
        'error-full-mark-problem' => 'please enter fullMark greater than zero',
        'grade-MCQ-failed' => 'please enter grade greater than zero'
    ],
    'success' => [
        'success-saving' => 'User(s) created successfully.',
        'success-course' => 'Course created successfully.',
        'success-updating' => 'Course edited successfully.',
        'news-created' => 'News added successfully',
        'news-deleted' => 'News deleted successfully',
        'update-failed' => 'You entered nothing to update !'
    ],
    'judge_options' => [
        'title' => 'Judge Options to keep in mind while applying your test cases to scripts.',
        'options' => [
            'i' => 'Ignore case differences in file contents',
            'E' => 'Ignore changes due to tab expansion',
            'Z' => 'Ignore white space at line end',
            'b' => 'Ignore changes in the amount of white space',
            'B' => 'Ignore changes where lines are all blank',
            'w' => 'Ignore all white space',
            'SJ' => 'Sharp Judging',
        ],
        'quiz-options' => [
            'solve_many' => 'Students can solve this quiz more than once.'
        ]
    ],
    'coding_languages' => [
      'title' => 'Coding Languages'
    ],
    'profiles' => [
        'name' => 'Name',
        'email' => 'E-mail Address',
        'college_id' => 'College ID',
        'old_password' => 'Old Password',
        'new_password' => 'New Password',
        'confirm_new_password' => 'Confirm New Password',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'status' => 'Status',
        'member_since' => 'Member Since',
        'edit_profile' => 'Edit Profile',
        'account_setting' => 'Account Setting',
        'active' => 'Active',
        'code_forces_handle' => 'CodeForces Handle',
        'code_forces_rating' => 'CodeForces Rating',
    ],
    'submissions' => [
        'title' => 'Submissions',
        'stat' => [
            'cols' => [
                '90' => 'More than 90%',
                '50' => 'More than 50%',
                '50_' => 'Less than 50%',
                'pending' => "Pending",
            ]
        ]
    ],
    'instructor' => [
        'title' => 'Instructor'
    ],
    'codeforces' => [
        'solved-count' => 'Solved Count',
        'problem-title' => 'Title',
        'diff' => 'Difficulty',
        'status' => 'Status'
    ],
    'news' => [
        'news-text' => 'News Text',
        'news' => 'News',
        'current-news' => 'Current News'
    ],
    'announcements' => [
        'add-announcement' => 'ADD new announcement',
        'content' => 'Announcement Content',
        'no_announcements_yet' => 'No announcements yet',
        'success' => 'Announcement added successfully',
        'deleted' => 'Announcement deleted successfully'
    ]
];