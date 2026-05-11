import { defineConfig } from 'vitepress'

export default defineConfig({
  title: "Laravel Fabric",
  description: "High-Fidelity Architectural Orchestration Engine",
  themeConfig: {
    logo: '/logo.png',
    nav: [
      { text: 'Home', link: '/' },
      { text: 'The Fabric Way', link: '/the-fabric-way' },
      { text: 'Changelog', link: '/CHANGELOG' }
    ],
    sidebar: [
      {
        text: 'Introduction',
        items: [
          { text: 'The Fabric Way', link: '/the-fabric-way' },
          { text: 'Features Suite', link: '/features' },
          { text: 'Architecture Standards', link: '/standards' }
        ]
      },
      {
        text: 'Core Engines',
        items: [
          { text: 'Loom (Introspection)', link: '/engine/loom' },
          { text: 'Lazarus (Healing)', link: '/engine/lazarus' },
          { text: 'Nexus (Context)', link: '/engine/nexus' },
          { text: 'Dynasty (STI)', link: '/engine/dynasty' }
        ]
      },
      {
        text: 'Ghost Plugins',
        items: [
          { text: 'Alchemy (Auth)', link: '/plugins/alchemy' },
          { text: 'Polyglot (I18n)', link: '/plugins/polyglot' },
          { text: 'Hydrate (Seeding)', link: '/plugins/hydrate' }
        ]
      },
      {
        text: 'Releases',
        items: [
          { text: 'Changelog', link: '/CHANGELOG' }
        ]
      }
    ],
    socialLinks: [
      { icon: 'github', link: 'https://github.com/ahtesham-clcbws/laravel-fabric' }
    ],
    footer: {
      message: 'Released under the Commercial License.',
      copyright: 'Copyright © 2026-present Laravel Fabric'
    }
  }
})
