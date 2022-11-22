<?php

namespace App\Enums;

use BenSampo\Enum\FlaggedEnum;

/**
 * @method static static ReadComments()
 * @method static static WriteComments()
 * @method static static EditComments()
 * @method static static DeleteComments()
 * @method static static Member()
 * @method static static Moderator()
 * @method static static Admin()
 * @method static static None()
 */
final class UserPermissions extends FlaggedEnum
{
    const ReadComments      = 1 << 0; //1
    const WriteComments     = 1 << 1; //2
    const EditComments      = 1 << 2; //4
    const DeleteComments    = 1 << 3; //8

    // Shortcuts
    const Member = self::ReadComments | self::WriteComments; // Read and write.
    const Moderator = self::Member | self::EditComments; // All the permissions a Member has, plus Edit.
    const Admin = self::Moderator | self::DeleteComments; // All the permissions a Moderator has, plus Delete.
}
