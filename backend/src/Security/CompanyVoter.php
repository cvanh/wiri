<?php

namespace App\Security;

use App\Entity\Company;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CompanyVoter extends Voter
{
    // these strings are just invented: you can use anything
    protected const VIEW = 'view';
    protected const EDIT = 'edit';
    protected const DELETE = 'delete';
    protected const CREATE = 'create';


    protected function supports(string $attribute, mixed $subject): bool
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        // only vote on `Company` objects
        if (!$subject instanceof Company) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        // you know $subject is a Company object, thanks to `supports()`
        /** @var Company $company */
        $company = $subject;

        return match($attribute) {
            self::VIEW => $this->canView($company, $user),
            self::EDIT => $this->canEdit($company, $user),
            self::DELETE => $this->canDelete($company, $user),
            self::CREATE => $this->canCreate($company, $user),
            default => throw new \LogicException('This code should not be reached!')
        };
    }

    private function canDelete(Company $company, User $user): bool
    {
        // user is owner so they can do what ever they want
        return in_array($user, (array) $company->getOwners(),true);
    }

    private function canCreate(Company $company, User $user): bool
    {
        // the user should be logged in but they can create when they want
        return (bool) $user;
    }

    private function canView(Company $company, User $user): bool
    {
        // user can always view
        return true;
    }

    private function canEdit(Company $company, User $user): bool
    {
        return in_array($user, (array) $company->getOwners(),true);
    }
}
