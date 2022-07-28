from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.hashers import make_password
from django.shortcuts import redirect, render
from django.template.defaulttags import register
from pets.models import Pet, PetRace

from .forms import *


@register.filter('startswith')
def startswith(text, starts):
    if isinstance(text, str):
        return text.startswith(starts)
    return False


def index(request):
    print('INSERT INTO `pet_race` (`id`, `race`, `species_id`) VALUES '+', '.join(
        ["('{0}', '{1}', '{2}')".format(i.pk, i.race, i.species.pk) for i in PetRace.objects.all()]))
    return render(request, 'index.html')


def login_view(request):
    if request.method == 'POST':
        username = request.POST['email']
        password = request.POST['password']
        user = authenticate(request, username=username, password=password)
        if user is not None:
            login(request, user)
            return redirect('/')
    return render(request, 'login.html')


def register(request):
    if request.user.is_authenticated:
        return redirect('/')
    if request.method == 'POST':
        form = RegisterForm(request.POST)
        if form.is_valid():
            form.save()
            return redirect('login')
    else:
        form = RegisterForm()
    return render(request, 'register.html', {'form': form})
