<?php declare(strict_types = 1);

namespace App\PHPStan\AdditionalReflections;

use Nette\Security\IIdentity;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;

/**
 * Allows properties of User Identity.
 */
class UserIdentityReflectionExtension implements PropertiesClassReflectionExtension
{
    /**
     * @var Type[]
     */
    private $properties = [];

    public function __construct()
    {
        $this->properties = [
            'browser' => new StringType(),
            'email'   => new StringType(),
            'ip'      => new StringType(),
            'login'   => new StringType(),
            'name'    => new StringType(),
            'passwd'  => new StringType(),
        ];
    }

    public function hasProperty(ClassReflection $classReflection, string $propertyName): bool
    {
        return $classReflection->getName() === IIdentity::class && array_key_exists($propertyName, $this->properties);
    }

    public function getProperty(ClassReflection $classReflection, string $propertyName): PropertyReflection
    {
        return new UserIdentityPropertyReflection($classReflection, $this->getPropertyType($propertyName));
    }

    private function getPropertyType(string $propertyName): Type
    {
        return $this->properties[$propertyName];
    }
}
