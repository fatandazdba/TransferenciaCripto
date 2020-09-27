<?php

namespace Tests\Unit;

use http\Env\Response;
use TransferenciaCripto\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{

    protected function successfulRegistrationRoute()
    {
        return route('login');
    }

    protected function registerGetRoute()
    {
        return route('register');
    }

    protected function registerPostRoute()
    {
        return route('register');
    }

    protected function guestMiddlewareRoute()
    {
        return route('/');
    }

    protected function elementsFromDataBase()
    {
        return count(User::all());
    }

    public function testUserCanViewARegistrationForm()
    {
        $response = $this->get($this->registerGetRoute());
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    public function testFirtuserRegister()
    {
        $user = User::get()->first();
        $this->assertEquals('Freddy Tandazo', $user->name);
        $this->assertEquals('freddy@gmail.com', $user->email);
        $this->assertTrue(Hash::check('12345678', $user->password));
    }

    public function testUserCanRegister()
    {
        Event::fake();
        $response = $this->post($this->registerPostRoute(), [
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => 'test12345678',
            'password_confirmation' => 'test12345678'// User
        ]);
        $this->assertCount($this->elementsFromDataBase(), $users = User::all());
    }

    public function testUserCannotRegisterWithoutName()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'name' => '',
            'email' => 'john@gmail.com',
            'password' => 'test12345678',
            'password_confirmation' => 'test12345678',
        ]);
        $users = User::all();
        $this->assertCount($this->elementsFromDataBase(), $users);
        $this->assertFalse(session()->hasOldInput('email'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutEmail()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'name' => 'John',
            'email' => '',
            'password' => 'test12345678',
            'password_confirmation' => 'test12345678',
        ]);
        $users = User::all();
        $this->assertCount($this->elementsFromDataBase(), $users);
        $this->assertFalse(session()->hasOldInput('name'));
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithInvalidEmail()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'name' => 'John',
            'email' => 'invalid-email',
            'password' => 'test12345678',
            'password_confirmation' => 'test12345678',
        ]);
        $users = User::all();
        $this->assertCount($this->elementsFromDataBase(), $users);
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutPassword()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'name' => 'John',
            'email' => 'john@gmail.com',
            'password' => '',
            'password_confirmation' => '',
        ]);
        $users = User::all();
        $this->assertCount($this->elementsFromDataBase(), $users);
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithoutPasswordConfirmation()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'name' => 'Doe',
            'email' => 'john@gmail.com',
            'password' => 'test12345678',
            'password_confirmation' => '',
        ]);
        $users = User::all();
        $this->assertCount($this->elementsFromDataBase(), $users);
        $this->assertGuest();
    }

    public function testUserCannotRegisterWithPasswordsNotMatching()
    {
        $response = $this->from($this->registerGetRoute())->post($this->registerPostRoute(), [
            'name' => 'Doe',
            'email' => 'john@gmail.com',
            'password' => 'test12345678',
            'password_confirmation' => 'i-love-symfony',
        ]);
        $users = User::all();
        $this->assertCount($this->elementsFromDataBase(), $users);
        $this->assertGuest();
    }
}