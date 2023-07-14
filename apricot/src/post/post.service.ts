import { Body, Delete, Get, Injectable, Param, Post, Put } from '@nestjs/common'
import { CreatePostDto } from './post.dto/create_post.dto'
import { InjectRepository } from '@nestjs/typeorm'
import { Postentity } from './post.entity'
import { Repository } from 'typeorm'

@Injectable()
export class PostService {

  constructor(@InjectRepository(Postentity) private readonly postRepository: Repository<Postentity>) {}
  async getAll(){
    return this.postRepository.find()
  }

  async create(dto: CreatePostDto){
    return this.postRepository.save(post)
  }
  async getById(id: string){
    return this.postRepository.findOne({
      where: {
        id: Number(id)
      }
    })
  }


  async update(id: string, dto: CreatePostDto){
    const post = await this.getById(id)
    post.content = dto.content
    post.userName = dto.userName
    return post
  }

  async delete(id: string){
    return this.postRepository.delete({id:  Number(id)})
  }
}
