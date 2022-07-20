from django.contrib.auth import get_user_model
from django.forms import *


class RegisterForm(ModelForm):
    class Meta:
        model = get_user_model()
        fields = ('email', 'password', 'first_name',
                  'last_name', 'address', 'birthday')
        labels = {'password': 'Contraseña',
                  'first_name': 'Nombre',
                  'last_name': 'Apellidos'}
        widgets = {'email': EmailInput(attrs={'autocomplete': 'email'}),
                   'password': PasswordInput(attrs={'autocomplete': 'new-password'}),
                   'first_name': TextInput(attrs={'autocomplete': 'given-name'}),
                   'last_name': TextInput(attrs={'autocomplete': 'family-name'}),
                   'birthday': DateInput(attrs={'type': 'date', 'autocomplete': 'bday'})}

    repeat_password = CharField(
        label='Repita la contraseña', widget=PasswordInput(attrs={'autocomplete': 'new-password'}))

    def __init__(self,  *args, **kwargs):
        super().__init__(*args, **kwargs)

        for field in self.fields.values():
            field.widget.attrs.update(
                {'class': 'form-control', 'placeholder': field.label})

    def clean(self):
        cleaned_data = super().clean()
        if cleaned_data.get('password') != cleaned_data.get('repeat_password'):
            self.add_error('repeat_password', 'No coinciden las contraseñas.')
        return cleaned_data

    def is_valid(self):
        result = super().is_valid()
        for x in (self.fields if '__all__' in self.errors else self.errors):
            attrs = self.fields[x].widget.attrs
            attrs.update({'class': attrs.get('class', '') + ' is-invalid'})
        return result

    def save(self, commit=True):
        user = super(RegisterForm, self).save(commit=False)
        user.set_password(self.cleaned_data['password'])
        if commit:
            user.save()
        return user
