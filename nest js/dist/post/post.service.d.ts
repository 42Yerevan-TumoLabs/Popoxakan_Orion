import { Repository } from 'typeorm';
import { CreatePostDto } from './create-post.dto';
import { PostEntity } from './post.entity';
export declare class PostService {
    private readonly postRepository;
    constructor(postRepository: Repository<PostEntity>);
    getAll(): Promise<PostEntity[]>;
    create(dto: CreatePostDto): Promise<PostEntity>;
    getById(id: string): Promise<PostEntity>;
    update(id: string, dto: CreatePostDto): Promise<PostEntity>;
    delete(id: string): Promise<import("typeorm").DeleteResult>;
}
