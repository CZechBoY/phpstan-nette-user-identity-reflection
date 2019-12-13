<?php declare(strict_types = 1);

namespace App\PHPStan\AdditionalReflections;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\TrinaryLogic;
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

    public function __construct(ClassReflection $declaringClassReflection, Type $type)
    {
        $this->declaringClassReflection = $declaringClassReflection;
        $this->type = $type;
    }

    public function getDeclaringClass(): ClassReflection
    {
        return $this->declaringClassReflection;
    }

    public function isStatic(): bool
    {
        return false;
    }

    public function isPrivate(): bool
    {
        return false;
    }

    public function isPublic(): bool
    {
        return true;
    }

	public function getDocComment(): ?string
	{
		return null;
	}

	public function getReadableType(): Type
	{
		return $this->type;
	}

	public function getWritableType(): Type
	{
		return $this->type;
	}

	public function canChangeTypeAfterAssignment(): bool
	{
		return true;
	}

	public function isReadable(): bool
	{
		return true;
	}

	public function isWritable(): bool
	{
		return true;
	}

	public function isDeprecated(): TrinaryLogic
	{
		return TrinaryLogic::createNo();
	}

	public function getDeprecatedDescription(): ?string
	{
		return null;
	}

	public function isInternal(): TrinaryLogic
	{
		return TrinaryLogic::createNo();
	}
}
