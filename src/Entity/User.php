<?php
/**
 * Created by PhpStorm.
 * User: Agata
 * Date: 05/03/2018
 * Time: 10:46
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository") */
class User implements UserInterface, \Serializable {/**
 * @ORM\Column(type="integer") * @ORM\Id
151
 * @ORM\GeneratedValue(strategy="AUTO")
 */
    private $id;
    /**
     * @ORM\Column(type="string", length=25, unique=true) */
    private $username;
    /**
     * @ORM\Column(type="string", length=64) */
    private $password;
    /**
     * @ORM\Column(type="json_array") */
    private $roles = [];

    public function getSalt() {
        // no salt needed since we are using bcrypt
        return null;
    }
    public function eraseCredentials() {
    }

    /** @see \Serializable::serialize() */
    public function serialize(){
    return serialize(array( $this->id,
        $this->username,
        $this->password, ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
    list ( $this->id,
        $this->username,
        $this->password,
        ) = unserialize($serialized);
    }

    public function getRoles() {

        $roles = $this->roles;
        // ensure always contains ROLE_USER $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles($roles) {
        $this->roles = $roles;
        return $this;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }
}