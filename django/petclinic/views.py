from django.shortcuts import render, redirect
from django.template.defaulttags import register
from django.contrib.auth import logout


@register.filter('startswith')
def startswith(text, starts):
    if isinstance(text, str):
        return text.startswith(starts)
    return False


def index(request):
    return render(request, 'index.html')


def login_view(request):
    return render(request, 'login.html')


def logout_view(request):
    logout(request)
    return redirect('index')


def register(request):
    return render(request, 'register.html')
