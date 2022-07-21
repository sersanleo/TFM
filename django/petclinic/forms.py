from django.contrib.auth import get_user_model
from django.contrib.auth.forms import AuthenticationForm, UserCreationForm
from django.forms import *


class LoginForm(AuthenticationForm):
    def __init__(self,  *args, **kwargs):
        kwargs['label_suffix'] = ''
        super().__init__(*args, **kwargs)

        self.fields['username'].widget = EmailInput(
            attrs={'class': 'form-control', 'placeholder': self.fields['username'].label})
        self.fields['password'].widget.attrs.update(
            {'class': 'form-control', 'placeholder': self.fields['password'].label})


class RegisterForm(UserCreationForm):
    class Meta:
        model = get_user_model()
        fields = ('email', 'first_name',
                  'last_name', 'address', 'birthday')
        labels = {'first_name': 'Nombre',
                  'last_name': 'Apellidos'}
        widgets = {'email': EmailInput(attrs={'autocomplete': 'email'}),
                   'first_name': TextInput(attrs={'autocomplete': 'given-name'}),
                   'last_name': TextInput(attrs={'autocomplete': 'family-name'}),
                   'birthday': DateInput(attrs={'type': 'date', 'autocomplete': 'bday'})}

    def __init__(self,  *args, **kwargs):
        kwargs['label_suffix'] = ''
        super().__init__(*args, **kwargs)

        for field in self.fields.values():
            field.widget.attrs.update(
                {'class': 'form-control', 'placeholder': field.label})

    def is_valid(self):
        result = super().is_valid()
        for x in (self.fields if '__all__' in self.errors else self.errors):
            attrs = self.fields[x].widget.attrs
            attrs.update({'class': attrs.get('class', '') + ' is-invalid'})
        return result
