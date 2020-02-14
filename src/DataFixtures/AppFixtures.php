<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        
        #Enregistrement du role Admin}
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setFirstName('Mehdi')
                  ->setLastName('Testeur')
                  ->setEmail('mehdi@gmail.com')
                  ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                  ->addUserRole($adminRole);
        $manager->persist($adminUser);
        
        #Enregistrement des users}
        for($u = 1; $u<=20; $u++){
            $user = new User();
            
            $hash = $this->encoder->encodePassword($user, 'password');

            $user->setFirstName($faker->firstname)
                 ->setLastName($faker->lastname)
                 ->setEmail($faker->email)
                 ->setHash($hash);
                 
            $manager->persist($user);
        }

        $manager->flush();
    }
}
