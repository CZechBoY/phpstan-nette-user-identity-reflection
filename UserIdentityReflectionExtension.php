<?php declare(strict_types = 1);

namespace App\PHPStan\AdditionalReflections;

use Nette\Security\IIdentity;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Type\ArrayType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\StringType;
use PHPStan\Type\TrueOrFalseBooleanType;
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
            'browser' => new StringType(true),
            'email'   => new StringType(true),
            'ip'      => new StringType(true),
            'login'   => new StringType(false),
            'name'    => new StringType(true),
            'passwd'  => new StringType(false),
        ];
    }

    /**
     * @param ClassReflection $classReflection
     * @param string $propertyName
     *
     * @return bool
     */
    public function hasProperty(ClassReflection $classReflection, string $propertyName): bool
    {
        return $classReflection->getName() === IIdentity::class && array_key_exists($propertyName, $this->properties);
    }

    /**
     * @param ClassReflection $classReflection
     * @param string $propertyName
     *
     * @return PropertyReflection
     */
    public function getProperty(ClassReflection $classReflection, string $propertyName): PropertyReflection
    {
        return new UserIdentityPropertyReflection($classReflection, $this->getPropertyType($propertyName));
    }

    /**
     * @param string $propertyName
     *
     * @return Type
     */
    private function getPropertyType(string $propertyName): Type
    {
        return $this->properties[$propertyName];
    }
}
