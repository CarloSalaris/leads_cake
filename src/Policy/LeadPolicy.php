<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Lead;
use Authorization\IdentityInterface;

/**
 * Lead policy
 */
class LeadPolicy
{
    /**
     * Check if $user can add Lead
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Lead $lead
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Lead $lead)
    {
        return true;
    }

    /**
     * Check if $user can edit Lead
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Lead $lead
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Lead $lead)
    {
        if ($user->role === 'Admin') {
            return true;
        }

        if ($user->role === 'Agent' && $user->id === $lead->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Check if $user can delete Lead
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Lead $lead
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Lead $lead)
    {
        if ($user->role === 'Admin') {
            return true;
        }
        return false;
    }

    /**
     * Check if $user can view Lead
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Lead $lead
     * @return bool
     */
    public function canView(IdentityInterface $user, Lead $lead)
    {
        if ($user->role === 'Admin') {
            return true;
        }

        if ($user->role === 'Agent' && $user->id === $lead->user_id) {
            return true;
        }

        return false;
    }
}
