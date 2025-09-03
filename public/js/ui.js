// Ano dinâmico (se quiser usar no rodapé)
document.querySelectorAll('[data-year]').forEach(el => el.textContent = new Date().getFullYear());

// Navbar com sombra ao rolar
const navbar = document.querySelector('.navbar');
const onScroll = () => {
    if (!navbar) return;
    if (window.scrollY > 6) navbar.classList.add('scrolled');
    else navbar.classList.remove('scrolled');
};
document.addEventListener('scroll', onScroll); onScroll();

// Botão Voltar ao Topo
const backToTop = document.getElementById('backToTop');
if (backToTop){
    window.addEventListener('scroll', () => {
        if(window.scrollY > 500) backToTop.classList.add('show');
        else backToTop.classList.remove('show');
    });
    backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior:'smooth' }));
}

// Fechar offcanvas ao clicar num link (melhor UX no mobile)
document.querySelectorAll('.offcanvas a.nav-link, .offcanvas .btn').forEach(link => {
    link.addEventListener('click', () => {
        const offcanvasEl = link.closest('.offcanvas');
        if (!offcanvasEl) return;
        const off = bootstrap.Offcanvas.getInstance(offcanvasEl);
        if (off) off.hide();
    });
});

// Toggle de favorito (exemplo de interação)
document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-fav]');
    if (!btn) return;
    e.preventDefault();
    const active = btn.getAttribute('aria-pressed') === 'true';
    btn.setAttribute('aria-pressed', String(!active));
    btn.classList.toggle('active', !active);
});
