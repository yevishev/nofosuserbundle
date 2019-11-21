<?php


namespace App\Services;


use App\Entity\User;
use App\Entity\Company;
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
        $tempList  = $this->em->getRepository(User::class)->findAllUsers();
        $list['Choose referrer'] = '0';
        foreach ($tempList as $value){
            $data = "{$value['first_name']} {$value['last_name']} (тел. {$value['phone']})";
            $list[$data] = $value['id'];
        }
        return $list;
    }

    public function queryCompany($name_company)
    {
        $com = $this->em->getRepository(Company::class)->findByCompany($name_company);
        if(empty($com)) {
            $com = new Company();
            $com->setNameCompany($name_company);
            $this->em->persist($com);
        }
        return $com;
    }
}