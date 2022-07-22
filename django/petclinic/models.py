from django.utils.translation import gettext_lazy as _
from datetime import date

from django.contrib.auth.models import AbstractUser, BaseUserManager
from django.core.validators import *
from django.db.models import *

'''
https://www.fomfus.com/articles/how-to-use-email-as-username-for-django-authentication-removing-the-username/
'''


class UserManager(BaseUserManager):
    use_in_migrations = True

    def _create_user(self, email, password, **extra_fields):
        """Create and save a User with the given email and password."""
        if not email:
            raise ValueError('The given email must be set')
        email = self.normalize_email(email)
        user = self.model(email=email, **extra_fields)
        user.set_password(password)
        user.save(using=self._db)
        return user

    def create_user(self, email, password=None, **extra_fields):
        """Create and save a regular User with the given email and password."""
        extra_fields.setdefault('is_staff', False)
        extra_fields.setdefault('is_superuser', False)
        return self._create_user(email, password, **extra_fields)

    def create_superuser(self, email, password, **extra_fields):
        """Create and save a SuperUser with the given email and password."""
        extra_fields.setdefault('is_staff', True)
        extra_fields.setdefault('is_superuser', True)

        if extra_fields.get('is_staff') is not True:
            raise ValueError('Superuser must have is_staff=True.')
        if extra_fields.get('is_superuser') is not True:
            raise ValueError('Superuser must have is_superuser=True.')

        return self._create_user(email, password, **extra_fields)


class User(AbstractUser):  # get_user_model()
    username = None
    email = EmailField('Correo electrónico', unique=True)
    first_name = CharField(
        _('first name'), max_length=150, blank=False, null=False)
    last_name = CharField(
        _('last name'), max_length=150, blank=False, null=False)
    address = CharField('Dirección', max_length=300, null=False)
    birthday = DateField('Cumpleaños', null=False,
                         validators=(MaxValueValidator(date.today),))

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = ('first_name', 'last_name', 'address', 'birthday')

    objects = UserManager()

    def __str__(self):
        return '{0} {1}'.format(self.first_name, self.last_name)
