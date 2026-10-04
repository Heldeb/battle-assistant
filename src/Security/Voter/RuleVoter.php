<?php

namespace App\Security\Voter;

use App\Entity\Rule;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class RuleVoter extends Voter
{

    // ========== Ajouter constantes par souci de maintenance ==========
    public const RULE_CREATE = 'rule_create';
    public const RULE_DELETE = 'rule_delete';
    public const RULE_EDIT = 'rule_edit';

    // ========== Vérifier le subject ==========
    protected function supports(string $attribute, mixed $rule): bool
    {

        if ($attribute === self::RULE_CREATE) {
            return true;
        }
        return in_array($attribute, [self::RULE_EDIT, self::RULE_DELETE,], true)
            && $rule instanceof Rule;
    }

    // ========== Vérifier le user ==========
    protected function voteOnAttribute(string $attribute, mixed $rule, TokenInterface $token, ?Vote $vote = null): bool
    {
        // Cette partie n'est pas indispensable mais je le laisse pour que ce soit plus explicite
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ========== Vérifier s'il est admin ==========s
        return in_array('ROLE_ADMIN', $token->getRoleNames(), true);
    }
}
