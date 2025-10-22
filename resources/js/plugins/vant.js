import { Button, Card, ConfigProvider, Icon, Tag } from 'vant';

export function registerVant(app) {
    app.use(ConfigProvider);
    app.use(Button);
    app.use(Card);
    app.use(Tag);
    app.use(Icon);
}

