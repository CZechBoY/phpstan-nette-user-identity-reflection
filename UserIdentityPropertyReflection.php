<?php declare(strict_types = 1);

namespace App\PHPStan\AdditionalReflections;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Type\Type;

class UserIdentityPropertyReflection implements PropertyReflection
{
    /**
     * @var ClassReflection
     */
    private $declaringClassReflection;

    /**
     * @var Type
     */
    private $type;

    /**
     * @param ClassReflection $declaringClassReflection
     * @param Type $type
     */
    public function __construct(ClassReflection $declaringClassReflection, Type $type)
    {
        $this->declaringClassReflection = $declaringClassReflection;
        $this->type = $type;
    }

    /**
     * @return ClassReflection
     */
    public function getDeclaringClass(): ClassReflection
    {
        return $this->declaringClassReflection;
    }

    /**
     * @return bool
     */
    public function isStatic(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return true;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }
}
