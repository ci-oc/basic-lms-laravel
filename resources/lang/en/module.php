<?php
/**
 * Created by PhpStorm.
 * User: andrewnagyeb
 * Date: 8/8/17
 * Time: 7:15 PM
 */
return [
    'copyright' => '2017 &copy; FCI - Helwan University (FCIH-LMS)',
    'create' => 'Create',
    'created_at' => 'Created At',
    'operations' => 'Operations',
    'current' => 'Current',
    'save' => 'Save',
    'submit' => 'Submit',
    'edit' => 'Edit',
    'view' => 'View',
    'you' => "You",
    'stat' => 'Statistics',
    'not_required' => 'Optional',
    'update' => 'Update',
    'addnew' => 'Add New',
    'delete' => 'Delete',
    'change' => 'Update',
    'reset' => 'Reset',
    'list' => 'List',
    'select_all' => "Select All",
    'click' => [
        'name' => 'Click here',
        'fields' => [
            'download-link' => 'to download file',
            'download-temp' => 'to download template'
        ]
    ],
    'download' => 'Download',
    'back_to_list' => 'Back to list',
    'are_you_sure' => 'Are you sure?',
    'description' => 'Description',
    'submit_quiz' => 'Submit answers',
    'no_entries_in_table' => 'No entries in table',
    'roles' => [
        'category_headers' => [
            'security' => 'Security Privileges',
            'hep' => 'High Educational Privileges',
            'lep' => 'Low Educational Privileges',
            'other' => 'Other Privileges'
        ],
    ],
    'index' => [
        'student_count' => '# Students Enrolled',
        'quiz_count' => '# Quizzes',
        'professor_count' => '# Professors Enrolled',
        'submission_count' => '# Submissions'
    ],
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
            'correct' => 'Correct',
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
        'caution' => 'Please note that after the time on the left finishes no answers will be accepted when you submit.',
        'quizzes-list' => 'Quizzes List',
        'solve' => 'Solve',
        'percentage' => 'Percentage',
        'show-for-more-than' => 'Showing for more than',
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
            'assistant_professor_title' => 'Assistant Professor(s)',
            'material' => 'Course Material',
            'material-1' => 'Upload more material',
            'material-name' => 'Material Name',
            'no_courses' => 'Sorry you don\'t have courses yet, please create course first.!',
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
            'empty_code' => 'Empty Code',
            'no-code-matches' => 'No matches were found for your code.'
        ],
    ],
    'bars' => [
        'home' => 'Home',
        'top-bar-no-news' => 'No News added yet.',
        'top-bar-news' => 'NEWS:',
        'top-bar-profile' => 'My Profile',
        'top-bar-logout' => 'Log Out',
        'sidebar_quizzes' => 'Quizzes',
        'sidebar_dashboard' => 'Dashboard',
        'sidebar_courses' => 'Courses',
        'sidebar_problems' => 'Problems',
        'sidebar_questions' => 'MCQ Questions',
        'sidebar_results' => 'Results',
        'sidebar_users' => 'Request New Users',
        'sidebar_submissions' => 'Submissions',
        'sidebar_announcements' => 'Announcements',
        'sidebar_security_questions' => 'Security Questions',
        'sidebar_profile' => 'Profile',
        'sidebar_enroll' => 'Register Course',
        'sidebar_construction' => 'Under Construction',
        'sidebar_plagiarism' => 'Plagiarism',
    ],
    'problems' => [
        'problems-list' => 'Problems List',
        'problem-name' => 'Problem Name',
        'new_problem' => 'New Problem',
        'example-input' => 'Example Input',
        'example-output' => 'Example Output',
        'lang' => 'Language',
        'code' => 'Code',
        'solving_percentage' => 'Solving Percentage',
        'lines_matched' => 'Lines Matched',
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
            'time_limit_note' => 'Note that maximum time limit is :value seconds',
            'mem_limit_note' => 'Note that maximum memory limit is :value KB',
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
        'instructors' => 'Instructor(s)',
        'password' => 'Password',
        'confirm-password' => 'Confirm Password',
        'register' => 'Register'
    ],
    'placeholders' => [
        'name' => 'Name',
        'email' => 'E-mail',
        'college-id' => 'College-id',
        'current-password' => 'Current Password',
        'not-available' => 'Not available yet.'

    ],
    'errors' => [
        'error-saving' => 'There was an error saving your file, please try again.',
        'error-create-user' => 'There was a trouble saving this\these user(s), please make sure of already existing account(s)',
        'error-access-code' => 'Invalid Access Code',
        'error-quiz-made-before' => 'Solve many option is turned off for this quiz.',
        'error-quiz-cannot-modify' => 'Quiz cannot be modified if it is available.',
        'error-problem-cannot-modify' => 'Question cannot be modified if its quiz is available.',
        'error-quiz-not-available' => 'Quiz is not available at the moment',
        'error-none-solved' => 'There are no results for this quiz yet.',
        'error-0-courses' => 'You have to create a course first.',
        'error-0-questions' => 'No questions have been assigned to this quiz yet.',
        'error-quiz-pending' => 'Quiz is still being remarked.',
        'error-name-field' => 'please change students names column name in excel file to "name"',
        'error-email-field' => 'please change emails column name in excel file to "email"',
        'error-id-field' => 'please change IDs column name in excel file to "id"',
        'error-access-code2' => 'sorry this access code is reserved, please choose another one',
        'error-course-title' => 'sorry this title is reserved, please choose another one',
        'error-grade-problem' => 'please enter grade greater than zero',
        'error-full-mark-problem' => 'please enter fullMark greater than zero',
        'grade-MCQ-failed' => 'please enter grade greater than zero',
        'error-login' => 'These credentials do not match our records, please check your email or password and try again.',
        'error-time-finished' => "Sorry your answer(s) wasn't/weren't submitted because quiz timeduration was finished already.",
        'error-quiz-duration' => 'Sorry quiz start time is equal to quiz end time, please change end time!',
        'error-quiz-time-gap' => 'Sorry the gap between start time and end time must be at least more than 1 minutes.',
        'error-material-name' => 'Please enter material name',
        'error-questions-errors' => 'Sorry you entered some wrong answers, please try again!',
        'error-saving-data' => 'There was an error saving your data, please try again.',
        'error-empty-material' => 'No material is uploaded yet!',
        'error-not-allowed-to-modify-course' => 'You are not allowed to modify this course.',
        'error-not-allowed-to-modify-problem' => 'You are not allowed to modify this course.',
        'error-processing' => 'There was an error while processing your request, please try again.',
        'error-create-quiz' => 'You must create quiz first.',
        'error-cannot-vew-result' => 'You cannot view result details at the moment.'

    ],
    'success' => [
        'success-saving' => 'User(s) created successfully.',
        'success-course' => 'Course created successfully.',
        'success-updating' => 'Course edited successfully.',
        'success-editing-quiz' => 'Quiz edited successfully',
        'success-editing-question' => 'question edited successfully',
        'news-created' => 'News added successfully',
        'news-deleted' => 'News deleted successfully',
        'update-failed' => 'You entered nothing to update !',
        'quiz-created-successfully' => 'Quiz created successfully.'
    ],
    'charts' => [
        'statistics' => 'Statistics',
        'got_full_mark' => '# of students who got full mark.',
        'not_passed' => '# of students who did not pass (under 50%).',
        'least_solved' => 'Least solved problem.',
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
            'SJ' => 'Sharp Judging ( FullMark or nothing )',
        ],
        'quiz-options' => [
            'solve_many' => 'Students can solve this quiz more than once.',
            'activate_plagiarism' => 'Activate MOSS plagiarism detection.',
            'share_results' => 'Share Results',
            'share_plagiarism' => 'Share Plagiarism Results',
            'results_details_w_respect_t_time' => "Show results with respect to quiz's date",
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
        'account_settings' => 'Account Settings'
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
        'add-announcement' => 'Add New Announcement',
        'content' => 'Announcement Content',
        'no_announcements_yet' => 'No announcements yet',
        'success' => 'Announcement added successfully',
        'deleted' => 'Announcement deleted successfully'
    ],
    'admin' => [
        'security-questions' => 'Security Questions',
        'caption' => 'Please answer the following questions to login as admin',
        'answer' => 'Your answer...',
        'answer-note' => 'Please answer the following questions to access your privileges!',
        'answer-note-1' => 'Please Go and answer the security questions to access your privileges!',
        'success-deletion' => 'Question deleted successfully.',
        'success-adding' => 'Question added successfully.',
        'error-deleting-question' => 'you cannot delete the last question',
        'success-solving-questions' => 'You answered questions correctly. Redirect to administration panel!',
        'online-judge-configuration' => 'Edit online judge constraints',
        'memory_limit' => 'Memory limit (minimum value is : 0)',
        'time_limit' => 'Time limit (maximum value is :  0)',
        'memory-time-success' => 'Data edited successfully',
        'error-memory-limit' => 'Please enter memory limit greater than zero',
        'error-time-limit' => 'Please enter time limit greater than zero'
    ]
];