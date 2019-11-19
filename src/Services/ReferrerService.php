<?php


namespace App\Services;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ReferrerService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function query()
    {
        $tempList  = $this->em->getRepository(User::class)->findByExampleField();
        $list = [];
        foreach ($tempList as $value){
            $data = "{$value['first_name']} {$value['last_name']} (тел. {$value['phone']})";
            $list[$data] = $value['id'];
        }
        return $list;
    }
}