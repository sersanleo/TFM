from datetime import timedelta

from appointments.models import *
from django.test import TestCase
from django.urls import reverse
from django.utils import timezone
from petclinic.models import *

from pets.models import *


class PetTestCase(TestCase):
    def setUp(self):
        self.vet = User.objects.create_superuser(email='vet1@petclinic.com', password='vet1', first_name='Test vet1',
                                                 last_name='Test', address='Test address', birthday=date(1999, 8, 10))
        self.customer1 = User.objects.create_user(email='customer1@petclinic.com', password='customer1', first_name='Test customer1',
                                                  last_name='Test', address='Test address', birthday=date(1999, 8, 10))
        self.customer2 = User.objects.create_user(email='customer2@petclinic.com', password='customer2', first_name='Test customer2',
                                                  last_name='Test', address='Test address', birthday=date(1999, 8, 10))

        PetSpecies.objects.bulk_create([
            PetSpecies(name='Perro'),
            PetSpecies(name='Gato'),
        ])
        PetRace.objects.bulk_create([
            PetRace(race='Chihuahua',
                    species=PetSpecies.objects.get(name='Perro')),
            PetRace(race='Siamés', species=PetSpecies.objects.get(name='Gato')),
        ])
        Pet.objects.bulk_create([
            Pet(owner=User.objects.get(email='customer1@petclinic.com'),
                race=PetRace.objects.get(race='Chihuahua'), name='Firulais'),
            Pet(owner=User.objects.get(email='customer2@petclinic.com'),
                race=PetRace.objects.get(race='Siamés'), name='Bob'),
        ])

    def test_delete_successfully(self):
        pet_count = Pet.objects.count()
        pet = Pet.objects.first()

        self.client.force_login(self.vet)
        self.client.post(reverse('pet:delete'), {
            'pet': pet.pk
        })

        self.assertEquals(Pet.objects.count(), pet_count - 1)

    def test_delete_unsuccessfully(self):
        pet_count = Pet.objects.count()
        pet = Pet.objects.first()

        self.client.force_login(self.customer1)
        self.client.post(reverse('pet:delete'), {
            'pet': pet.pk
        })

        self.assertEquals(Pet.objects.count(), pet_count)

    def test_edit_successfully(self):
        pet = Pet.objects.first()
        new_name = pet.name + 'test'

        self.client.force_login(self.vet)
        response = self.client.post(reverse('pet:edit', args=[pet.pk]), {
            'owner': pet.owner.pk,
            'race': pet.race.pk,
            'name': new_name
        })

        self.assertEquals(Pet.objects.first().name, new_name)
        self.assertEquals(response.status_code, 302)

    def test_edit_unsuccessfully(self):
        pet = Pet.objects.first()

        self.client.force_login(self.vet)
        response = self.client.post(reverse('pet:edit', args=[pet.pk]), {
            'owner': pet.owner.pk,
            'race': pet.race.pk,
            'name': pet.name,
            'birthday':  (timezone.now() + timedelta(days=2)).strftime('%Y-%m-%d')
        })

        self.assertTrue(response.context['form'].errors['birthday'])
        self.assertEquals(Pet.objects.first().birthday, pet.birthday)
        self.assertEquals(response.status_code, 200)

    def test_create_successfully(self):
        pet_count = Pet.objects.count()

        self.client.force_login(self.vet)
        response = self.client.post(reverse('pet:create'), {
            'owner': self.customer1.pk,
            'race': PetRace.objects.first().pk,
            'name': 'Test pet'
        })

        self.assertEquals(Pet.objects.count(), pet_count + 1)
        self.assertEquals(response.status_code, 302)
