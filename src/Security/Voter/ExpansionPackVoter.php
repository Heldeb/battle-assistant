<?php

namespace App\Security\Voter;

use App\Entity\ExpansionPack;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Vote;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class ExpansionPackVoter extends Voter
{
    // ========== Ajouter constantes par souci de maintenance ==========
    public const EXPANSIONPACK_CREATE = 'expansionpack_create';
    public const EXPANSIONPACK_DELETE = 'expansionpack_delete';
    public const EXPANSIONPACK_EDIT = 'expansionpack_edit';

    // ========== Vérifier le subject ==========
    protected function supports(string $attribute, mixed $expansionPack): bool
    {

        if ($attribute === self::EXPANSIONPACK_CREATE) {
            return true;
        }
        return in_array($attribute, [self::EXPANSIONPACK_EDIT, self::EXPANSIONPACK_DELETE,], true)
            && $rule instanceof ExpansionPack;
    }


    // ========== Vérifier le user ==========
    protected function voteOnAttribute(string $attribute, mixed $expansionPack, TokenInterface $token, ?Vote $vote = null): bool
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
