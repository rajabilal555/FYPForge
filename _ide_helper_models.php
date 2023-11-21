<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Advisor
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property array $field_of_interests
 * @property string $room_no
 * @property int $slots
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $available_slots
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectAdvisorInvite> $invites
 * @property-read int|null $invites_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectAdvisorInvite> $pendingProjectInvites
 * @property-read int|null $pending_project_invites_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\AdvisorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereFieldOfInterests($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereRoomNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereSlots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Advisor whereUpdatedAt($value)
 */
	class Advisor extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

namespace App\Models{
/**
 * App\Models\EvaluationPanel
 *
 * @property int $id
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectEvaluation> $projectEvaluations
 * @property-read int|null $project_evaluations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationPanel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationPanel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationPanel query()
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationPanel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationPanel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationPanel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EvaluationPanel whereUpdatedAt($value)
 */
	class EvaluationPanel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \App\Enums\ProjectStatus $status
 * @property int|null $evaluation_panel_id
 * @property int|null $advisor_id
 * @property string|null $next_evaluation_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Advisor|null $advisor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectAdvisorInvite> $advisorInvites
 * @property-read int|null $advisor_invites_count
 * @property-read \App\Models\EvaluationPanel|null $evaluation_panel
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectFile> $files
 * @property-read int|null $files_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectMemberInvite> $memberInvites
 * @property-read int|null $member_invites_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectAdvisorInvite> $pendingAdvisorInvites
 * @property-read int|null $pending_advisor_invites_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectMemberInvite> $pendingMemberInvites
 * @property-read int|null $pending_member_invites_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereAdvisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereEvaluationPanelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereNextEvaluationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectAdvisorInvite
 *
 * @property int $id
 * @property string $message
 * @property int $project_id
 * @property int $advisor_id
 * @property int $sent_by
 * @property \App\Enums\ProjectInviteStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Advisor $advisor
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Student $sender
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite whereAdvisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite whereSentBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectAdvisorInvite whereUpdatedAt($value)
 */
	class ProjectAdvisorInvite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectEvaluation
 *
 * @property int $id
 * @property int $project_id
 * @property int $student_id
 * @property int $evaluation_panel_id
 * @property string $status
 * @property string $remarks e.g. can be improved
 * @property int $score
 * @property string|null $evaluation_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EvaluationPanel|null $panel
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereEvaluationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereEvaluationPanelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectEvaluation whereUpdatedAt($value)
 */
	class ProjectEvaluation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectFile
 *
 * @property int $id
 * @property string $name
 * @property string $storage_path
 * @property string $storage_disk
 * @property int $project_id
 * @property int $student_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereStorageDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereStoragePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereUpdatedAt($value)
 */
	class ProjectFile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectMemberInvite
 *
 * @property int $id
 * @property string $message
 * @property int $project_id
 * @property int $student_id
 * @property int $sent_by
 * @property \App\Enums\ProjectInviteStatus $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\Student $sender
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite whereSentBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectMemberInvite whereUpdatedAt($value)
 */
	class ProjectMemberInvite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectQuery
 *
 * @property int $id
 * @property string $query
 * @property int $project_id
 * @property int $student_id
 * @property string|null $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery whereQuery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectQuery whereUpdatedAt($value)
 */
	class ProjectQuery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProjectTask
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property int $project_id
 * @property string|null $remarks
 * @property string|null $due_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectTask whereUpdatedAt($value)
 */
	class ProjectTask extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $registration_no
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property int|null $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectAdvisorInvite> $advisorInvites
 * @property-read int|null $advisor_invites_count
 * @property-read mixed $name_with_registration
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProjectMemberInvite> $memberInvites
 * @property-read int|null $member_invites_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\StudentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereRegistrationNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 */
	class Student extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

namespace App\Models{
/**
 * This is the class for Staff Users i.e. Coordinator, Moderators, etc.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

