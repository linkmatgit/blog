<?php

namespace App\Form;


use App\Entity\User;
use App\Http\Admin\Type\CategoryChoiceType;
use App\Http\Admin\Type\DateTimeType;
use App\Http\Admin\Type\EditorType;
use App\Http\Admin\Type\UserChoiceType;
use App\Type\SwitchType;
use DateTimeInterface;
use ReflectionClass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Génère un formulaire de manière automatique en lisant les propriété d'un objet
 */
class AutomaticForm extends AbstractType
{
    const TYPES = [
        'string'                 => TextType::class,
        'bool'                   => SwitchType::class,
        'int'                    => NumberType::class,
        'float'                    => NumberType::class,
        DateTimeInterface::class => DateTimeType::class,
        UploadedFile::class      => FileType::class,
        User::class              => UserChoiceType::class
        ];

    const NAMES = [
        'short' => TextareaType::class,
        'color' => ColorType::class,
        'position' => NumberType::class,
        'category' => CategoryChoiceType::class,
        'content' => EditorType::class
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $data = $options['data'];
        $refClass = new ReflectionClass($data);
        $classProperties = $refClass->getProperties(\ReflectionProperty::IS_PUBLIC);
        foreach ($classProperties as $property) {
            $name = $property->getName();
            /** @var \ReflectionNamedType|null $type */
            $type = $property->getType();
            if ($type === null) {
                return;
            }
            if (array_key_exists($name, self::NAMES)) {
                $builder->add($name, self::NAMES[$name], [
                    'required' => false
                ]);
            } elseif (array_key_exists($type->getName(), self::TYPES)) {
                $builder->add($name, self::TYPES[$type->getName()], [
                    'required' => !$type->allowsNull() && $type->getName() !== 'bool'
                ]);
            } else {
                throw new \RuntimeException(sprintf(
                    'Impossible de trouver le champs associé au type %s dans %s::%s',
                    $type->getName(),
                    get_class($data),
                    $name
                ));
            }
        }
    }
}
