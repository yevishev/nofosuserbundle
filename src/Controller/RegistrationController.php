<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use App\Services\ReferrerService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{


    /**
     * @var ReferrerService
     */
    private $rs;

    public function __construct(ReferrerService $rs)
    {
        $this->rs = $rs;
    }

    /**
     * @Route("/register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @return Response
     * @throws Exception
     */
    public function register(Request $request,
                             UserPasswordEncoderInterface $passwordEncoder,
                             GuardAuthenticatorHandler $guardHandler,
                             LoginFormAuthenticator $authenticator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('enterPassword')->getData()
                )
            );
            //Ищем есть ли компания с таким названием
            $comFromForm = $form->get('company')->getData();
            //Получаем id пригласившего/(или никто не пригласил) пользователя
            $referrer = $this->getDoctrine()
                            ->getRepository(User::class)
                            ->find($form->get('referrer')->getData());
            //Записываем id пригласившего пользователя в пользователя, который регистрируется
            //затем отображаем его имя в странице профиля
            $user->setInviter($referrer);
            //Записываем id компании, если она существует. Если нет, то запишем ее в сущность
            //Компании
            $user->setCompany($this->rs->queryCompany($comFromForm));
            //Запишем дату регистрации
            $user->setDateReg(new \DateTimeImmutable());
            //Запишем роль (поскольку роль одна запишем константу)
            $user->setRoles(array('ROLE_USER'));
            $entityManager->persist($user);
            //Соберем и сохраним данные
            $entityManager->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
