import create_config from '@kucrut/vite-for-wp'
import Components from 'unplugin-vue-components/vite'
import AutoImport from 'unplugin-auto-import/vite'
import Vue from '@vitejs/plugin-vue'
import Unocss from 'unocss/vite'
import type { UserConfig } from 'vite'

export default create_config({
  client: 'client/main.ts',
  settings: 'settings/main.ts',
}, 'dist', {
  plugins: [
    Vue({ reactivityTransform: true }),
    Unocss(),
    Components({ dts: true }),
    AutoImport({
      imports: [
        'vue',
        'vue/macros',
        // 'vue-router',
        // '@vueuse/core',
      ],
      dts: true,
    }),
  ],
} as UserConfig)
