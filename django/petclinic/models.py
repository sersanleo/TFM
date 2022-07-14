from django.contrib.auth.models import AbstractUser
from django.core.validators import *
from django.db.models import Model, DateField, CharField, EmailField
from django.contrib.auth.models import AbstractUser, BaseUserManager


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
    '''
    https://www.fomfus.com/articles/how-to-use-email-as-username-for-django-authentication-removing-the-username/
    '''
    username = None
    email = EmailField(unique=True)
    address = CharField('Dirección', max_length=300, null=False)
    birthday = DateField('Cumpleaños', null=False)

    USERNAME_FIELD = 'email'
    REQUIRED_FIELDS = ('address', 'birthday')

    objects = UserManager()
