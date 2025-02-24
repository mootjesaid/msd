<?php

namespace App\Twig\Components;

use App\Entity\Room;  // Import the EventRoom entity
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class Form extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    // Explicitly define the type for initialFormData
    #[LiveProp]
    public ?Room $initialFormData = null;  // Now specifying EventRoom as the type
    public ?string $dir = 'admin_';

    #[LiveProp]
    public string $formType = ''; // Dynamic form type

    protected function instantiateForm(): FormInterface
    {
        $data = $this->initialFormData ?? new $this->formType();

        return $this->createForm($this->formType, $data, [
            'action' => $data->getId() ? $this->generateUrl('app_'. $this->dir . $this->initialFormData .'_edit', ['id' => $data->getId()]) : $this->generateUrl('app_'. $this->dir . $this->initialFormData .'_new'),
        ]);
    }
}
