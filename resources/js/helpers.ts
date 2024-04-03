import { Banner } from "./models";

export function getBannerName(banner: Banner) {
    if(banner.name) return banner.name;

    let featured_five_star = banner.characters.find(f => f.rarity == 5);
    if(featured_five_star) {
        return featured_five_star.featured_name? featured_five_star.featured_name : 'No name'
    }
    if(banner.characters.length == 0 && banner.weapons.length > 0) {
        return 'Epitome Invocation';
    }

    return 'No name';
}
