# Terminal Midnight — Design Guide
**Laravel Sweden** · `design/concept-d-terminal-midnight`

---

## Concept

Terminal Midnight is a dark, monospaced design language inspired by terminal/CLI aesthetics. It uses **Swedish brand colours** (navy blue + yellow) recontextualised as a "developer's screen at midnight" — dark navy backgrounds, amber-yellow accents, and a dot-grid texture.

The UI speaks in **command-line vocabulary**: `$ commands`, `// comments`, `[STATUS]` badges, and `→` list indicators. Every label is a CLI invocation; every section has a prompt.

---

## Colour Palette

| Variable | Hex | Role |
|---|---|---|
| `--tm-bg` | `#0d1b2a` | Page background (dark navy) |
| `--tm-surface` | `#142638` | Card / panel background |
| `--tm-surface-2` | `#1a2c40` | Elevated surface |
| `--tm-surface-hover` | `#1a3050` | Hover state for surfaces |
| `--tm-border` | `#1e3a4a` | Border colour |
| `--tm-yellow` | `#f5d563` | **Primary accent** — buttons, prompts, highlights |
| `--tm-blue` | `#4d9fd4` | Secondary accent — links, labels (WCAG AA ≥ 4.5:1 on bg) |
| `--tm-blue-bg` | `#005293` | Blue for surface/bg only, not text |
| `--tm-text` | `#c9d8e8` | Primary body text |
| `--tm-body` | `#f0ede6` | High-contrast body copy |
| `--tm-muted` | `#7fa0bb` | Secondary/muted text (WCAG AA ≥ 4.5:1 on bg) |
| `--tm-muted-dim` | `#4a6580` | Decorative/non-text accents only |
| `--tm-green` | `#4ade80` | Success states `[OK]` |
| `--tm-red` | `#ff6b6b` | Error states `[ERROR]` |

### WCAG Notes
- `--tm-muted` (#7fa0bb) ≥ 4.5:1 against `--tm-bg` — safe for body text
- `--tm-blue` (#4d9fd4) ≥ 4.5:1 against `--tm-bg` — safe for body text
- `--tm-blue-bg` (#005293) and `--tm-muted-dim` (#4a6580) are below threshold — **decorative/surface use only**

### Legacy Variable Remapping
The CSS file maps all old light-theme variables to TM equivalents so pre-existing components work without changes:
- `--black` → `var(--tm-bg)`
- `--white` → `var(--tm-surface)`
- `--red` → `var(--tm-yellow)`
- `--gray-500/600` → `var(--tm-muted)`
- `--gray-700/800` → `var(--tm-text)`

---

## Typography

**Single font stack throughout** — no mix of typefaces.

```css
font-family: 'JetBrains Mono', 'Fira Code', 'Cascadia Code', ui-monospace, monospace;
```

- Load via Google Fonts: `JetBrains+Mono:ital,wght@0,300;0,400;0,500;0,700;1,300`
- Body weight: `300` (light)
- UI labels: `400`–`500`
- Headings / prompts: `700`
- Heading letter-spacing: `-0.03em`
- `border-radius: 0` everywhere — sharp, not rounded

---

## Body & Background

```css
body {
    background-color: var(--tm-bg);
    background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    background-size: 24px 24px; /* subtle dot grid */
    color: var(--tm-body);
    font-family: 'JetBrains Mono', monospace;
    font-weight: 300;
}
```

Scrollbar: `scrollbar-color: var(--tm-yellow) var(--tm-bg)` + thin width.

---

## Terminal Vocabulary (HTML Patterns)

These are the recurring HTML idioms. Use them consistently across all pages.

### Section / Page headers
```html
<div class="section-cmd">$ events --filter=upcoming --sort=date</div>
<h2 class="section-title">Upcoming Events</h2>
```
The `section-cmd` is always `--tm-yellow`, `0.75rem`, JetBrains Mono.

### Comment labels
```html
<div class="hero-label">// swedish_laravel_association</div>
<div class="board-company">// Acme Corp</div>
```

### Prompt prefix on titles
```html
<h1 class="hero-title"><span class="hero-prompt">&gt;</span> Build with Laravel.</h1>
```
`hero-prompt` is `--tm-yellow`.

### Expand/collapse toggles
```
++ show more   /   -- show less
```

### Submit buttons
```
$ submit --talk
$ send --message
$ login --user
$ register --now
$ save --changes
```

### Status badges
```
[INFO]   — --tm-yellow
[DONE]   — --tm-muted
[OK]     — --tm-green (#4ade80)
[ERROR]  — --tm-red (#ff6b6b)
[ACTIVE] — --tm-green
```

### Arrow indicators
```html
<span class="stat-arrow">→</span>
```
Arrow colour: `--tm-yellow`.

### Terminal line (decorative)
```html
<div class="hero-terminal-line" aria-hidden="true">
    <span class="ht-prompt">~</span>
    <span class="ht-cmd">php artisan serve --host=stockholm --port=8000</span>
    <span class="ht-cursor">|</span>  <!-- blink animation -->
</div>
```

### Log bar on cards
```html
<div class="event-log-bar">
    <span class="event-log-level">[INFO]</span>
    <span class="event-log-date">2025-03-15</span>
    <span class="event-log-sep">·</span>
    <span class="event-log-loc">Stockholm</span>
</div>
```

---

## Buttons

All buttons use a **yellow fill-slide animation** on hover:

```css
.btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--tm-yellow);
    transform: translateX(-100%);
    transition: transform 200ms;
}
.btn:hover::before { transform: translateX(0); }
/* children must have position: relative; z-index: 1 */
```

| Class | Default state | Hover |
|---|---|---|
| `.btn-primary` | Yellow border + yellow text | Yellow fill + dark text |
| `.btn-secondary` | Border only + muted text | Surface-hover fill + text |
| `.btn-accent` | Yellow border + yellow text | Yellow fill + dark text |

Buttons use `border-radius: 0`, `font-family: JetBrains Mono`, `font-weight: 500`.

---

## Cards

```css
.card {
    background: var(--tm-surface);
    border: 1px solid var(--tm-border);
    border-radius: 0;
    padding: var(--spacing-8);
}
.card:hover { border-color: rgba(74, 101, 128, 0.6); }
```

Cards with left accent:
```css
border-left: 3px solid var(--tm-yellow); /* events */
border-left: 3px solid var(--tm-blue);  /* testimonials */
```

Board member cards get a `::before` top-border that appears in `--tm-blue` on hover.

---

## Navigation

Logo format: `laravel<span style="color: --tm-yellow">_sweden</span>`

Nav links: `./community`, `./events`, `./companies` etc.

Register CTA: `$ register --now` — yellow outlined button with fill-slide.

Blinking cursor on active nav item:
```html
<a class="nav-item">./events<span class="nav-cursor">|</span></a>
<!-- .nav-cursor shown on :hover with blink animation -->
```

---

## Forms

```css
.tm-input {
    background: var(--tm-surface);
    border: 1px solid var(--tm-border);
    border-radius: 0;
    color: var(--tm-text);
    font-family: 'JetBrains Mono', monospace;
}
.tm-input:focus {
    border-color: var(--tm-yellow);
    box-shadow: 0 0 0 2px rgb(245 213 99 / 0.15);
}
```

Labels: `--tm-text`. Help/hint: `--tm-muted`. Placeholder: `--tm-muted-dim`.

---

## Layout

- Max width: `1120px` (`--max-w`)
- Horizontal padding: `2rem` desktop, `1.25rem` mobile (`--px`)
- Section spacing: `--spacing-32` (8rem) between sections
- Section header: centred, `--spacing-12` bottom margin

---

## CSS File

All global styles live in `resources/css/terminal-midnight.css`.
Both layout files load it: `@vite(['resources/css/terminal-midnight.css'])`.
Component-specific styles stay as `<style>` blocks inside each Blade view.

---

## Footer Commands (Authenticity)

Use real Artisan commands, not duplicates:
- Hero: `php artisan serve --host=stockholm --port=8000`
- Footer: `php artisan schedule:run` ✓ running
