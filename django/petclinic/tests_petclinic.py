from datetime import date, timedelta

from appointments.models import *
from django.test import Client, TestCase
from django.urls import reverse
from django.utils import timezone
from pets.models import *

from .models import *


class RegisterTestCase(TestCase):
    def test_register_successfully(self):
        email = 'email@email.com'
        response = self.client.post(reverse('register'), {
            'email': email,
            'password1': 'Password235',
            'password2': 'Password235',
            'first_name': 'Test',
            'last_name': 'Test',
            'address': 'Test',
            'birthday': '2000-01-01',
        })

        self.assertRedirects(response, expected_url=reverse('login'))
        self.assertTrue(User.objects.filter(email=email).exists())

    def test_register_error(self):
        email = 'email@email.com'
        response = self.client.post(reverse('register'), {
            'email': email,
            'password1': 'Password235',
            'password2': 'incorrect',
            'first_name': 'Test',
            'last_name': 'Test',
            'address': 'Test',
            'birthday': '2000-01-01',
        })

        self.assertTrue(response.context['form'].errors['password2'])
        self.assertEquals(response.status_code, 200)
        self.assertFalse(User.objects.filter(email=email).exists())

    def test_login_successfully(self):
        password = 'vet1'
        vet = User.objects.create_superuser(email='vet1@petclinic.com', password=password, first_name='Test vet1',
                                            last_name='Test', address='Test address', birthday=date(1999, 8, 10))

        response = self.client.post(reverse('login'), {
            'username': vet.email,
            'password': password
        })
        self.assertEquals(response.status_code, 302)
