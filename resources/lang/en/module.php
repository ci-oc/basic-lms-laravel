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
    'update' => 'Update',
    'addnew' => 'Add New',
    'delete' => 'Delete',
    'reset' => 'Reset',
    'list' => 'List',
    'back_to_list' => 'Back to list',
    'are_you_sure' => 'Are you sure?',
    'description' => 'Description',
    'submit_quiz' => 'Submit answers',
    'results' => [
        'title' => 'My Results',
        'fields' => [
            'user' => 'User',
            'question' => 'Question',
            'correct' => 'Correct',
            'date' => 'Date',
            'result' => 'Score',
        ],
    ],
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
            'full-mark' => "Full Mark",
            'quiz' => 'Quiz Title',
            'question-text' => 'Question text',
            'code-snippet' => 'Code snippet',
            'answer-explanation' => 'Answer explanation',
            'more-info-link' => 'More info link',
            'input-format' => 'Input Format',
            'output-format' => 'Output Format',
            'duration' => 'Duration',
            'start-date' => 'Start Date',
            'end-date' => 'End Date',
        ],
    ],
    'courses' => [
        'relation-title' => 'Course',
        'no-quizzes' => 'No Quizzes Created',
        'title' => 'New Course',
        'enroll-course' => 'Enroll',
        'fields' => [
            'course' => 'Course Title',
            'access_code' => 'Access Code',
            'desc' => 'Description',
            'excel' => 'Excel Sheet :',
            'assistant_professor' => 'Assistant Professor-Email ( Please separate by coma if they are many )',
        ],
    ],
    'results' => [
        'title' => 'My Results',
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
        'sidebar_quizzes' => 'Quizzes',
        'sidebar_dashboard' => 'Dashboard',
        'sidebar_courses' => 'Courses',
        'sidebar_problems' => 'Problems',
        'sidebar_questions' => 'MCQ Questions',
        'sidebar_results' => 'Results',
        'sidebar_new_users' => 'Request New Users'
    ],
    'problems' => [
        'problems-list' => 'Problems List',
        'new_problem' => 'New Problem',
        'example-input' => 'Example Input',
        'example-output' => 'Example Output',
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
    ],
    'placeholders' => [
        'name' => 'Name',
        'email' => 'E-mail',
        'college-id' => 'College-id',

    ],
    'errors' => [
        'error-saving' => 'There was an error saving your file, please try again.',
        'error-create-user' => 'There was a trouble saving this\these user(s), please make sure of already existing account(s)',
    ],
    'success' => [
        'success-saving' => 'User(s) created successfully.'
    ],
    'judge_options' => [
        'title' => 'Judge Options to keep in mind while applying your test cases to scripts.',
        'options' => [
            'i' => 'Ignore case differences in file contents',
            'E' => 'Ignore changes due to tab expansion',
            'Z' => 'Ignore white space at line end',
            'b' => 'Ignore changes in the amount of white space',
            'B' => 'Ignore changes where lines are all blank',
            'w' => 'Ignore all white space'
        ]
    ]

];