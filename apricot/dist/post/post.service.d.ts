import { CreatePostDto } from './post.dto/create_post.dto';
import { Postentity } from './post.entity';
import { Repository } from 'typeorm';
export declare class PostService {
    private readonly postRepository;
    constructor(postRepository: Repository<Postentity>);
    getAll(): Promise<Postentity[]>;
    create(dto: CreatePostDto): Promise<any>;
    getById(id: string): Promise<Postentity>;
    update(id: string, dto: CreatePostDto): Promise<Postentity>;
    delete(id: string): Promise<import("typeorm").DeleteResult>;
}
